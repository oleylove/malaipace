<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Webconfig;
use App\Room;
use App\User;
use App\Lease;
use App\Invoice;
use App\Maintenance;
use App\Notice;
use Image;
Use PDF;
use Jenssegers\Date\Date;
Date::setLocale('th');

class GuestController extends Controller
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

    //สมาชิกเข้าสู่ระบบ
    public function index()
    {
        try {
            $lease = Lease::where('user_id',Auth::id())->first();
            if($lease){
                $user = User::findOrFail(Auth::id());
                if ($user->status != 'สมาชิกใหม่' && $user->status != 'สมาชิกจอง') {
                    return view('user-profile',compact('user'));

                }elseif($user->status == 'สมาชิกจอง'){
                    return redirect('status-booking');
                }
            }else{
                return redirect('type-grid');
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //ตรวจสอบสถานะจองห้อง
    public function statusBooking()
    {
        try {
            $wcfg = Webconfig::latest()->first();
            $bkg = Lease::where('user_id',Auth::id())->first();
            $room = Room::findOrFail($bkg->rm_id);
            return view('status-booking', compact('bkg','room','wcfg'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //สมาชิกดูใบแจ้งหนี้
    public function invoice(Request $request)
    {
        try {
            $keyword = $request->get('status');
            $perPage = 10;

            $mulct = Invoice::where('date_pay',null)->where('status','รอชำระเงิน')->latest()->get();
            foreach ($mulct as $item) {
                if (get_Ymd(Date::now()) > get_Ymd($item->pay_date)){
                   $net_pay = $item->meter_wtp + $item->meter_ptp + $item->typ_centric + $item->typ_wifi + $item->typ_vehicle + $item->les_price;
                   $typ_mulct = $item->lease->room->type->mulct * dateDifference(get_Ymd(Date::now()),$item->pay_date);

                   Invoice::where('id', $item->id)
                    ->update([
                        'net_pay' => $net_pay + $typ_mulct,
                            'typ_mulct' => $typ_mulct,
                            'updated_at' => Date::now(),
                    ]);
                }
            }

            if (!empty($keyword)) {
                $invs = Invoice::where('les_id',Auth::user()->lease->id)
                    ->where('status', $keyword)
                    ->latest()
                    ->paginate($perPage);
            } else {
                $invs = Invoice::where('les_id',Auth::user()->lease->id)
                    ->latest()
                    ->paginate($perPage);
            }
            return view('user-invoice',compact('invs'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //สมาชิกจ่ายค่าเช่า
    public function payInvoice(Request $request)
    {
        try {
            $requestData = $request->all();
            $id = $requestData['inv_id'];

            $path = public_path('storage/slips');
            if (Storage::disk('public')->missing('slips')) {
                Storage::disk('public')->makeDirectory('slips');
            }

            if ($request->hasFile('inv_slip')) {
                $inv_slip = $request->file('inv_slip');
                $slipname = $id .'-invSlip-'. time() . '.' . $inv_slip->getClientOriginalExtension();
                $inv_slip->move($path, $slipname);
                $requestData['inv_slip'] = 'slips/'.$slipname;
                Invoice::where('id',$id)
                    ->update([
                        'status' => 'รอตรวจสอบ',
                        'date_pay' => Date::now(),
                        'slip' => $requestData['inv_slip']
                    ]);
            }
            return redirect('user-invoice');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //สมาชิกดูการซ่อมบำรุง
    public function maintenance(Request $request)
    {
        try {
            $keyword = $request->get('status');
            $perPage = 10;

            if (!empty($keyword)) {
                $mtns = Maintenance::where('rm_id',Auth::user()->lease->rm_id)
                ->where('status', $keyword)
                ->latest()
                ->paginate($perPage);

            } else {
                $mtns = Maintenance::where('rm_id',Auth::user()->lease->rm_id)
                    ->latest()
                    ->paginate($perPage);
            }
            return view('user-maintenance',compact('mtns'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //สมาชิกแจ้งซ่อมบำรุง
    public function notify_maintenance(Request $request)
    {
        try {
            $requestData = $request->all();
            $requestData['rm_id'] = Auth::user()->lease->rm_id;
            $requestData['date'] =  get_Ymd(Date::now());
            $requestData['status'] = 'แจ้งซ่อม';
            Maintenance::create($requestData);
            return redirect('user-maintenance')->with('success','แจ้งซ่อมเรียบร้อยแล้วคะ!');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //สมาชิกยกเลิกแจ้งซ่อมบำรุง
    public function maintenance_cancelled($id)
    {
        try {
            Maintenance::destroy($id);
            return redirect()->back()->with('success','ยกเลิกการแจ้งซ่อมเรียบร้อยแล้วคะ!');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //สมาชิกเปลี่ยนรูปโปรไฟล์
    public function changePhoto(Request $request)
    {
        try {
            $requestData = $request->all();

            $path = public_path('storage/users');
            if (Storage::disk('public')->missing('users')) {
                Storage::disk('public')->makeDirectory('users');
            }

            if ($request->hasFile('photo')) {
                if(Storage::exists('public/'.$request['photo_old'])){
                    Storage::delete('public/'.$request['photo_old']);
                }
                $photo = $request->file('photo');
                $photo_name = Auth::user()->id . 'Photo-' . time() . '.' . $photo->getClientOriginalExtension();
                Image::make($photo)->save($path . '/' . $photo_name);
                $requestData['photo'] = 'users/'.$photo_name;
                User::findOrFail(Auth::user()->id)->update(['photo' => $requestData['photo']]);
            }
            return redirect('user-profile')->with('success', 'เปลี่ยนรูปภาพเรียบร้อยแล้วคะ!');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //สมาชิกดูประกาศจากทางหอพัก
    public function notices()
    {
        try {
            $perPage = 15;
            $notice = Notice::latest()->paginate($perPage);
            $noticeCount = Notice::count();
            return view('user-notices', compact('notice','noticeCount'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //สมาชิกแจ้งย้ายออก
    public function checkout(Request $request)
    {
        try {
            $requestData = $request->all();

            if ($requestData['id'] == Auth::user()->lease->id) {
                Lease::where('id',$requestData['id'])
                    ->update([
                        'status' => 'แจ้งย้าย',
                        'checkout' => $requestData['checkout'],
                        'updated_at' => Date::now()
                ]);
                Room::where('id',Auth::user()->lease->room->id)
                    ->update([
                        'status' => 'แจ้งย้าย',
                        'updated_at' => Date::now()
                ]);
                user::where('id', Auth::user()->id)
                    ->update([
                        'status' => 'สมาชิกแจ้งย้าย',
                        'updated_at' => Date::now()
                ]);
                return redirect('user-profile')->with('success', 'แจ้งเรื่องย้ายออกร้อยแล้วคะ!');
            }else {
                return redirect('user-profile')->with('fail', 'ข้อมูลผิดพลาดกรุณาตรวจสอบข้อมูลใหม่!');
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
