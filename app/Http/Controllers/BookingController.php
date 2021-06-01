<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Lease;
use App\Room;
use App\User;
use Jenssegers\Date\Date;
Date::setLocale('th');

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //ผู้ดูแลดูข้อมูลการจองห้องทั้งหมด
    public function index(Request $request)
    {
       try {
            $status = $request->get('status');
            $perPage = 10;
            if(!empty($status)) {
                $booking = Lease::where('status', $status)->latest()->paginate($perPage);
                $bookingCount = Lease::where('status', $status)->count();
            }else {
                $booking = Lease::whereIn('status', ['จอง', 'ยืนยันจอง', 'ยกเลิกจอง'])->latest()->paginate($perPage);
                $bookingCount = Lease::whereIn('status', ['จอง', 'ยืนยันจอง', 'ยกเลิกจอง'])->count();
            }
            return view('booking.index', compact('booking','bookingCount'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function create($id)
    {
        // try {
        //     $booking = Lease::findOrFail($id);
        //     Room::where('id',$booking->rm_id)
        //         ->update([
        //             'status' => 'ว่าง',
        //             'updated_at' => Date::now(),
        //     ]);
        //     User::where('id',$booking->user_id)
        //         ->update([
        //             'status' => 'สมาชิกใหม่',
        //             'updated_at' => Date::now(),
        //     ]);
        //     return redirect()->back()->with('success', 'คืนสถานะห้องให้ว่างเรียบร้อยแล้วคะ!');
        // } catch (Exception $ex) {
        //     return $ex->getMessage();
        // }
    }


    //สมากชิกจองห้องพัก
    public function store(Request $request)
    {
        // user booking
        try {
            $requestData = $request->all();

            $path = public_path('storage/slips');
            if (Storage::disk('public')->missing('slips')) {
                Storage::disk('public')->makeDirectory('slips');
            }

            $room = Room::findOrFail($requestData['rm_id']);
            if ($request->hasFile('bkg_slip')) {
                $requestData['user_id'] = Auth::id();
                $requestData['typ_price'] = $room->type->price;
                $requestData['typ_booking'] = $room->type->booking;
                $requestData['typ_doposit'] = $room->type->doposit;
                $requestData['status'] = 'จอง';
                $booking = Lease::create($requestData);
                // upload slip booking
                $bkg_slip = $request->file('bkg_slip');
                $slipname = $booking->id .'-bkgSlip-'. time() . '.' . $bkg_slip->getClientOriginalExtension();
                $bkg_slip->move($path, $slipname);
                $requestData['bkg_slip'] = 'slips/'.$slipname;
                $booking = Lease::findOrFail($booking->id);
                $booking->update($requestData);
                User::where('id', Auth::id())
                    ->update([
                        'status' => 'สมาชิกจอง',
                        'updated_at' => Date::now(),
                    ]);
                Room::where('id', $room->id)
                    ->update([
                        'status' => 'จอง',
                        'updated_at' => Date::now(),
                    ]);
            }
            return redirect('status-booking')->with('success', 'จองห้องเรียบร้อยแล้วคะ!');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
     }


    //ผูดูแลดูข้อมูลการจองห้องพัก
    public function show($id)
    {
        try {
            $booking = Lease::findOrFail($id);
            return view('booking.show', compact('booking'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
     }


    //ผุ้ดูแลคืนสะถานะจองห้องพัก
    public function edit($id)
    {
        try {
            $booking = Lease::findOrFail($id);
            Lease::where('id',$booking->id)
                ->update([
                    'status' => 'จอง',
                    'updated_at' => Date::now(),
            ]);
            Room::where('id',$booking->rm_id)
                ->update([
                    'status' => 'จอง',
                    'updated_at' => Date::now(),
            ]);
            User::where('id',$booking->user_id)
                ->update([
                    'status' => 'สมาชิกจอง',
                    'updated_at' => Date::now(),
            ]);

            return redirect()->back()->with('success', 'คืนสถานะการจองห้องเรียบร้อยแล้วคะ!');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
     }

    //ผู้ดูแลยืนยันการจองห้องพัก
    public function update(Request $request, $id)
    {
        try {
            Lease::where('id',$id)
            ->update([
                'status' => 'ยืนยันจอง',
                'updated_at' => Date::now(),
            ]);
            return redirect()->back()->with('success', 'ยืนยันการจองห้องเรียบร้อยแล้วคะ!');

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //ผู้ดูแลยืนยันการจองห้องพัก
    public function ajaxupdate(Request $request)
    {
        try {
            $data = Lease::where('id',$request->get('bkgid'))
                ->update([
                    'status' => 'ยืนยันจอง',
                    'updated_at' => Date::now(),
                ]);
            // return response()->json($data);
            return response()->json(['success'=>'data']);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //ผู้ดูแลยกเลิกการจองห้องพัก
    public function destroy($id)
    {
        try {
            $booking = Lease::findOrFail($id);
            Lease::where('id',$id)
                ->update([
                    'status' => 'ยกเลิกจอง',
                    'updated_at' => Date::now(),
            ]);
            Room::where('id',$booking->rm_id)
                ->update([
                    'status' => 'ว่าง',
                    'updated_at' => Date::now(),
            ]);
            User::where('id',$booking->user_id)
                ->update([
                    'status' => 'สมาชิกใหม่',
                    'updated_at' => Date::now(),
            ]);
            return redirect()->back()->with('success', 'ยกเลิกการจองห้องเรียบร้อยแล้วคะ!');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
