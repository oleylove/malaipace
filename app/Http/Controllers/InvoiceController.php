<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Invoice;
use App\Room;
use App\Lease;
use Jenssegers\Date\Date;
Date::setLocale('th');

class InvoiceController extends Controller
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
            $number = $request->get('number');
            $status = $request->get('status');
            $building = $request->get('building');
            $perPage = 8;

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

            if (!empty($status)) {
                $invoice = Invoice::where('status', $status)->latest()->paginate($perPage);
                $invoiceCount = Invoice::where('status', $status)->count();

            }elseif (!empty($number) && !empty($building)) {

                $room = Room::select('id')->where('number', $number)->where('building', $building)->first();
                $les_id = !empty($room) ? $room->lease->id : '';

                $invoice = Invoice::where('les_id', $les_id)->latest()->paginate($perPage);

                $invoiceCount = Invoice::where('les_id', $les_id)->count();

            } else {
                $invoice = Invoice::latest()->paginate($perPage);
                $invoiceCount = Invoice::count();
            }

            return view('invoice.index', ['navbarSeach' => 'invoice'], compact('invoice','invoiceCount'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        try {
            $rooms = Room::where('status','เช่า')->get();
            return view('invoice.create',compact('rooms'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //ผุ้ดูแล กรอกมิเตอร์น้ำ-ไฟ ล่าสุด เพื่อออกใบแจ้งหนี้
    public function store(Request $request)
    {
        try {
            $requestData = $request->all();
            $rooms = Room::where('status','เช่า')->get();
            foreach($rooms as $item){
                Room::where('id', $requestData['id'.$item->id])
                        ->update([
                            'meter_wn' => $requestData['meter_wn'.$item->id],
                            'meter_pn' => $requestData['meter_pn'.$item->id]
                        ]);
            }

            $lease = Lease::where('status','เช่าอยู่')->orderBy('id','asc')->get();
            foreach($lease as $item){

                $invoice = Invoice::where('les_id',$item->id)->where('status','ชำระเงินแล้ว')->orderBy('id','desc')->limit(1)->first();

                if($invoice){
                    $meter_wo = $invoice->meter_wn;
                    $meter_po = $invoice->meter_pn;
                }else{
                    $meter_wo = $item->meter_ws;
                    $meter_po = $item->meter_ps;
                }

                $meter_wn = $item->room->meter_wn;
                $meter_wu = $meter_wn - $meter_wo;
                $meter_wpu = $item->room->type->water;
                $meter_wtp = $meter_wu * $meter_wpu;

                $meter_pn = $item->room->meter_pn;
                $meter_pu = $meter_pn - $meter_po;
                $meter_ppu = $item->room->type->power;
                $meter_ptp = $meter_pu * $meter_ppu;

                if($item->typ_wifi == 'no'){
                    $typ_wifi = 0;
                }else{
                    $typ_wifi = $item->room->type->wifi;
                }
                if($item->typ_vehicle == 'no'){
                    $typ_vehicle = 0;
                }else{
                    $typ_vehicle = $item->room->type->vehicle;
                }

                $net_pay = ($meter_wtp + $meter_ptp) + ($item->room->type->centric + $typ_wifi + $typ_vehicle) + $item->typ_price;


                Invoice::create([
                    'les_id' => $item->id,
                    'date' => get_Ymd(Date::now()),
                    'pay_date' => get_Ymd(Date::now()->add('1 month')->format('Y-m-05')),
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
                    'typ_centric' => $item->room->type->centric,
                    'typ_wifi' => $typ_wifi,
                    'typ_vehicle' => $typ_vehicle,
                    'typ_mulct' => 0,
                    'les_price' => $item->typ_price,
                    'net_pay' => $net_pay,
                    'status' => 'รอชำระเงิน',
                ]);
            }
            return redirect('/invoice')->with('success', 'ออกใบแจ้งหนี้ใหม่เรียบร้อยแล้วคะ!');

        } catch (Exception $ex) {

            return $ex->getMessage();

        }
    }


    //ผู้ดูแลอัปโหลดหลักฐานการชำระเงินค่าเช่า
    public function update_slip(Request $request, $id)
    {
        try {
            $requestData = $request->all();

            $path = public_path('storage/slips');
            if (Storage::disk('public')->missing('slips')) {
                Storage::disk('public')->makeDirectory('slips');
            }

            if ($request->hasFile('slip')) {
                if(Storage::exists('public/'.$request['slip_old'])){
                    Storage::delete('public/'.$request['slip_old']);
                }
                $inv_slip = $request->file('slip');
                $slipname = $id .'-invSlip-'. time() . '.' . $inv_slip->getClientOriginalExtension();
                $inv_slip->move($path, $slipname);
                $requestData['slip'] = 'slips/'.$slipname;
                $invoice = Invoice::findOrFail($id);
                $invoice->update($requestData);
            }
            return redirect('invoice/'.$id)->back()->with('success', 'อัปโหลดหลักฐานการชำระะงินค่าเช่าใหม่เรียบร้อยแล้วคะ!');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function confirm_payment($id)
    {
        try
        {
            Invoice::where('id', $id)
                ->update([
                    'status' => 'ชำระเงินแล้ว',
                    'updated_at' => Date::now(),
                ]);
            return redirect()->back()->with('success', 'ยืนยันชำระเงินแล้วเรียบร้อยแล้วคะ!');
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
            $invoice = Invoice::findOrFail($id);
            return view('invoice.show', compact('invoice'));
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
            $invoice = Invoice::findOrFail($id);
            return view('invoice.edit', compact('invoice'));
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

            $path = public_path('storage/slips');
            if (Storage::disk('public')->missing('slips')) {
                Storage::disk('public')->makeDirectory('slips');
            }

            if ($request->hasFile('slip')) {
                if(Storage::exists('public/'.$request['slip_old'])){
                    Storage::delete('public/'.$request['slip_old']);
                }
                $inv_slip = $request->file('slip');
                $slipname = $id .'-invSlip-'. time() . '.' . $inv_slip->getClientOriginalExtension();
                $inv_slip->move($path, $slipname);
                $requestData['slip'] = 'slips/'.$slipname;
                $invoice = Invoice::findOrFail($id);
                $invoice->update($requestData);
            }
            $invoice = Invoice::findOrFail($id);

            if (empty($invoice->date_pay) && $requestData['status'] == 'ชำระเงินแล้ว') {
                $requestData['date_pay'] = Date::now();
            }

            $invoice->update($requestData);
            return redirect('invoice/'.$id)->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้วคะ!');

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
