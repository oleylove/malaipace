<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Lease;
use App\Room;
use App\User;
use App\Income;
use App\Webconfig;
use App\Invoice;
use Jenssegers\Date\Date;
Date::setLocale('th');
use App\Functions;

class LeaseController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {

            $search = $request->get('search');
            $status = $request->get('status');
            $perPage = 8;

            if (!empty($search)) {
                $lease = Lease::whereNotIn('status', ['จอง', 'ยืนยันจอง','ยกเลิกจอง'])->where('idcard', 'LIKE', "%$search%")->latest()->paginate($perPage);
                $leaseCount = Lease::whereNotIn('status', ['จอง', 'ยืนยันจอง','ยกเลิกจอง'])->where('idcard', 'LIKE', "%$search%")->count();

            }elseif($status == 'เช่าอยู่' || $status == 'ย้ายออก') {
                $lease = Lease::where('status',$status)->latest()->paginate($perPage);
                $leaseCount = Lease::where('status',$status)->count();

            }elseif($status == 'แจ้งย้าย') {
                $lease = Lease::whereIn('status', ['แจ้งย้าย', 'ยืนยันแจ้งย้าย'])->latest()->paginate($perPage);
                $leaseCount = Lease::whereIn('status', ['แจ้งย้าย', 'ยืนยันแจ้งย้าย'])->count();
            }else {
                $lease = Lease::whereNotIn('status', ['จอง', 'ยืนยันจอง','ยกเลิกจอง'])->latest()->paginate($perPage);
                $leaseCount = Lease::whereNotIn('status', ['จอง', 'ยืนยันจอง','ยกเลิกจอง'])->count();
            }

            return view('lease.index',['navbarSeach' => 'lease'], compact('lease','leaseCount'));

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        try {
            $lease = Lease::findOrFail($id);
            return view('lease.create', compact('lease'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $requestData = $request->all();
            $lease = Lease::findOrFail($requestData['id']);

            $path = public_path('storage/leases');
            if (Storage::disk('public')->missing('leases')) {
                Storage::disk('public')->makeDirectory('leases');
            }

            // upload card coppy
            if ($request->hasFile('idcard_doc')) {
                $idcard_doc = $request->file('idcard_doc');
                $cardcoppy = $lease->id .'-CardCoppy-'. time() . '.' . $idcard_doc->getClientOriginalExtension();
                $idcard_doc->move($path, $cardcoppy);
                $requestData['idcard_doc'] = 'leases/'.$cardcoppy;
            }

            // upload lease doc
            if ($request->hasFile('lease_doc')) {
                $lease_doc = $request->file('lease_doc');
                $leasedoc = $lease->id .'-LeaseDoc-'. time() . '.' . $lease_doc->getClientOriginalExtension();
                $lease_doc->move($path, $leasedoc);
                $requestData['lease_doc'] = 'leases/'.$leasedoc;
            }

            if ($requestData['typ_wifi'] == 'yes') {
                $typ_wifi = $lease->room->type->wifi;
            } else {
                $typ_wifi = 0;
            }
            if ($requestData['typ_vehicle'] == 'yes') {
                $typ_vehicle = $lease->room->type->vehicle;
            } else {
                $typ_vehicle = 0;
            }

            $requestData['date_start'] = get_Ymd(Date::now());
            $requestData['date_end'] = get_Ymd(Date::now()->add('6 month'));
            $requestData['net_pay'] = ($lease->typ_doposit + $typ_wifi + $typ_vehicle + $lease->typ_price) - $lease->typ_booking;
            $requestData['status'] = 'เช่าอยู่';
            $requestData['updated_at'] = Date::now();

            $lease->update($requestData);
            Room::where('id', $lease->rm_id)
                ->update([
                    'status' => 'เช่า',
                    'meter_wn' => $requestData['meter_ws'],
                    'meter_pn' => $requestData['meter_ps'],
                    'updated_at' => Date::now(),
            ]);
            User::where('id', $lease->user_id)
                ->update([
                    'status' => 'สมาชิกเช่า',
                    'updated_at' => Date::now(),
            ]);

            return redirect('lease/'.$lease->id)->with('success', 'ทำสัญญาเช่าห้องเรียบร้อยแล้วคะ!');

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $lease = Lease::findOrFail($id);
            return view('lease.show', compact('lease'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $lease = Lease::findOrFail($id);
            return view('lease.edit', compact('lease'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        try {
            $requestData = $request->all();

            $path = public_path('storage/leases');
            if (Storage::disk('public')->missing('leases')) {
                Storage::disk('public')->makeDirectory('leases');
            }

            $lease = Lease::findOrFail($id);
            if ($request->hasFile('idcard_doc')) {
                if(Storage::exists('public/'.$request['idcard_doc_old'])){
                    Storage::delete('public/'.$request['idcard_doc_old']);
                }
                $idcard_doc = $request->file('idcard_doc');
                $cardcoppy = $lease->id .'-CardCoppy-'. time() . '.' . $idcard_doc->getClientOriginalExtension();
                $idcard_doc->move($path, $cardcoppy);
                $requestData['idcard_doc'] = 'leases/'.$cardcoppy;
            }

            if ($request->hasFile('lease_doc')) {
                if(Storage::exists('public/'.$request['lease_doc_old'])){
                    Storage::delete('public/'.$request['lease_doc_old']);
                }
                $lease_doc = $request->file('lease_doc');
                $leasedoc = $lease->id .'-LeaseDoc-'. time() . '.' . $lease_doc->getClientOriginalExtension();
                $lease_doc->move($path, $leasedoc);
                $requestData['lease_doc'] = 'leases/'.$leasedoc;
            }
            $lease->update($requestData);

            return redirect('lease')->with('success', 'แก้ไขสัญญาเช่าห้องเรียบร้อยแล้วคะ!');

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    // ผุ้ดูแลทำการยืนยันการแจ้งย้าย
    public function confirm_checkout(Request $request, $id)
    {

        try {
            $requestData = $request->all();
            if ($requestData['id'] == $id) {
                $lease = Lease::findOrFail($id);
                $requestData['status'] = 'ยืนยันแจ้งย้าย';
                $requestData['update_at'] = Date::now();
                $lease->update($requestData);
                return redirect()->back()->with('success', 'ยืนยันการแจ้งย้ายเรียบร้อยแล้วคะ!');

            }else {
                return redirect()->back()->with('fail', 'ข้อมูลผิดพลาด กรุณาตรวจสอบให้ถูกต้อง');

            }


        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    // ผุ้ดูแลทำเรื่องย้ายออกและออกใบเสร็จ
    public function checkout(Request $request ,$id)
    {
        try {
            $requestData = $request->all();

            if ($requestData['meter_wn'] < $requestData['meter_wo']  || $requestData['meter_wn'] <  $requestData['meter_wo']) {
                return redirect()->back()->with('fail', 'ข้อมูลผิดพลาด! กรุณาตรวจสอบเลขมิเตอร์น้ำและเลขมิเตอร์ไฟให้ถูกต้อง 01');

            } else {
                $lease = Lease::findOrFail($id);
                $invoice = Invoice::where('les_id',$id)->orderBy('id','desc')->limit(1)->first();
                if ($invoice) {
                    if ($invoice->meter_wn > $requestData['meter_wn'] || $invoice->meter_pn > $requestData['meter_pn']) {
                       return redirect()->back()->with('fail', 'ข้อมูลผิดพลาด! กรุณาตรวจสอบเลขมิเตอร์น้ำและเลขมิเตอร์ไฟให้ถูกต้อง =>'.$invoice->id. ' => ' .$lease->id);
                    }else{
                        $meter_wo = $invoice->meter_wn;
                        $meter_po = $invoice->meter_pn;
                    }
                } else {
                    $meter_wo = $lease->meter_ws;
                    $meter_po = $lease->meter_ps;
                }
                $meter_wn = $requestData['meter_wn'];
                $meter_wu = $meter_wn - $meter_wo;
                $meter_wpu = $lease->room->type->water;
                $meter_wtp = $meter_wu * $meter_wpu;

                $meter_pn = $requestData['meter_pn'];
                $meter_pu = $meter_pn - $meter_po;
                $meter_ppu = $lease->room->type->power;
                $meter_ptp = $meter_pu * $meter_ppu;

                $typ_wifi = 0;
                $typ_vehicle = 0;
                $type_centric = $lease->room->type->centric + $requestData['typ_clean'];

                if ($requestData['doposit'] == 'คืนเงินประกัน') {
                    $typ_doposit = $lease->typ_doposit;

                } elseif ($requestData['doposit'] == 'ไม่คืนเงินประกัน') {

                    $typ_doposit = 0;
                }

                $net_pay = ($meter_wtp + $meter_ptp + $type_centric) - $typ_doposit;
                if ($requestData['id'] == $id) {
                    $inv_checkout =  Invoice::create([
                        'les_id' => $lease->id,
                        'date' => Date::now(),
                        'pay_date' => Date::now(),
                        'date_pay' => Date::now(),
                        'meter_wo' => $meter_wo,
                        'meter_wn' => $meter_wn,
                        'meter_wu' => $meter_wu,
                        'meter_wpu' => $meter_wpu,
                        'meter_wtp' => $meter_wtp,
                        'meter_po' => $meter_po,
                        'meter_pn' => $meter_pn,
                        'meter_pu' => $meter_pu,
                        'meter_ppu' => $meter_ppu,
                        'meter_ptp' => $meter_ptp,
                        'typ_centric' => $type_centric,
                        'typ_wifi' => $typ_wifi,
                        'typ_vehicle' => $typ_vehicle,
                        'typ_mulct' => 0,
                        'les_price' => 0,
                        'net_pay' => $net_pay,
                        'typ_doposit' => $typ_doposit,
                        'status' => 'ชำระเงินแล้ว',
                    ]);
                    Room::where('id', $requestData['rm_id'])
                        ->update([
                            'status' => 'ว่าง',
                            'meter_wn' => $requestData['meter_wn'],
                            'meter_pn' => $requestData['meter_pn'],
                            'updated_at' => Date::now()
                    ]);
                    Lease::where('id', $id)
                        ->update([
                            'status' => 'ย้ายออก',
                            'updated_at' => Date::now()
                    ]);
                    user::where('id', $lease->user_id)
                        ->update([
                            'status' => 'สมาชิกออกแล้ว',
                            'updated_at' => Date::now()
                    ]);
                    return redirect()->back()->with('success', 'ทำเรื่องย้ายออกเรียบร้อยแล้วคะ!');
                } else {
                    return redirect()->back()->with('fail', 'ข้อมูลผิดพลาด! รหัสไม่ตรงกันกรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนค่ะ!');
                }
            }

        } catch (Exception $ex) {

            return $ex->getMessage();

        }
    }
    // ผุ้ดูแลทำการยกเลิกนการแจ้งย้าย
    public function cancelCheckout(Request $request, $id)
    {
        try {
            $requestData = $request->all();
            if ($requestData['id'] == $id) {
                $lease = Lease::findOrFail($id);
                Lease::where('id',$id)
                    ->update([
                        'status' => 'เช่าอยู่',
                        'checkout' => null,
                        'updated_at' => Date::now()
                ]);
                Room::where('id',$lease->rm_id)
                    ->update([
                        'status' => 'เช่า',
                        'updated_at' => Date::now()
                ]);
                user::where('id', $lease->user_id)
                    ->update([
                        'status' => 'สมาชิกเช่า',
                        'updated_at' => Date::now()
                ]);
                return redirect()->back()->with('success', 'ยกเลิกเรื่องแจ้งย้ายออกร้อยแล้วคะ!');

            }else {
                return redirect()->back()->with('fail', 'ข้อมูลผิดพลาดกรุณาตรวจสอบข้อมูลใหม่!');
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        // try {
        //     Lease::destroy($id);
        //     return redirect('lease')->with('flash_message', 'Lease deleted!');
        // } catch (Exception $ex) {
        //     return $ex->getMessage();
        // }
    }

}
