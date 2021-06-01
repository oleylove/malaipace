<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Income;
use App\Lease;
use App\Invoice;
use App\Maintenance;
use App\Webconfig;
use App\Room;
Use PDF;
use Jenssegers\Date\Date;
Date::setLocale('th');

class PrintController extends Controller
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

    //ผู้ดูแลพิมพ์สัญญาเช่า
    public function leaseDocumentPrint($id)
    {
        try {
            if ($id) {
                $lease = Lease::findOrFail($id);
                if ($lease) {
                    $wcfg = Webconfig::first();
                    $pdf = PDF::loadView('print.print-document-lease',['lease' => $lease],['wcfg' => $wcfg]);
                    return $pdf->stream($id.'-lease.pdf');
                } else {
                    return redirect('error/no-page');
                }
            } else {
                return redirect('error/no-page');
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //ผู้ดูแลพิมพ์ใบเสร็จรับเงินในการเช่า
    public function leaseReceiptPrint($id)
    {
        try {
            if ($id) {
                $receipt = Lease::findOrFail($id);
                if ($receipt) {
                    $wcfg = Webconfig::first();
                    $pdf = PDF::loadView('print.print-receipt-lease',['receipt' => $receipt],['wcfg' => $wcfg]);
                    return $pdf->stream($id.'-Receipt.pdf');

                } else {
                    return redirect('error/no-page');
                }
            } else {
                return redirect('error/no-page');
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //ผู้ดูแลพิมพ์ใบเสร็จรับเงินในการย้ายออก
    public function leaseReceiptCheckoutPrint($id)
    {
        try {
            if ($id) {
                $lease = Lease::findOrFail($id);
                if ($lease) {
                    $invoice = Invoice::where('les_id',$id)->where('les_price',0)->orderBy('id','desc')->limit(1)->first();
                    if ($invoice ) {
                        $wcfg = Webconfig::first();
                        $invoice = Invoice::findOrFail($invoice->id);
                        $pdf = PDF::loadView('print.print-receipt-checkout',['invoice' => $invoice],['wcfg' => $wcfg]);
                        return $pdf->stream($id.'-invoice-checkout.pdf');
                    } else {
                        return redirect('lease/'.$id)->with('fail', 'ข้อมูลผิดพลาดกรุณาตรวจสอบข้อมูลใหม่!');
                    }
                } else {
                    return redirect('error/no-page');
                }
            } else {
                return redirect('error/no-page');
            }

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //ผู้เช่า/ผู้ดูแลพิมพ์ใบเสร็จรับเงิน
    public function invoiceReceiptPrint($id)
    {
        try {
            if ($id) {
                $invoice = Invoice::findOrFail($id);
                if ($invoice) {
                    $wfc = Webconfig::first();
                    $pdf = PDF::loadView('print.print-receipt-invoice',['invoice'=> $invoice],['wfc' => $wfc]);
                    return $pdf->stream($id.'-invoice.pdf');
                } else {
                    return redirect('error/no-page');
                }
            } else {
                return redirect('error/no-page');
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function incomeReportPrint(Request $request)
    {
        try {

            if ($request->get('between') == 'true') {

                $begin = $request->get('begin');
                $end = $request->get('end');

                $incomes = Income::whereBetween('date', [$begin, $end])->latest()->get();
                $inc_remark = Income::select('remark')->whereBetween('date', [$begin, $end])->latest()->groupBy('remark')->get();
                $invoices = Invoice::whereBetween('date', [$begin, $end])->get();
                $leases = Lease::whereBetween('date_start', [$begin, $end])->sum('net_pay');
                $maintenances = Maintenance::whereBetween('date', [$begin, $end])->sum('price');

            } else {

                $incomes = Income::latest()->get();
                $inc_remark = Income::select('remark')->latest()->groupBy('remark')->get();
                $invoices = Invoice::latest()->get();
                $leases = Lease::sum('net_pay');
                $maintenances = Maintenance::sum('price');
            }
            $report = (object)[
                'incomes' => $incomes,
                'inc_remark' => $inc_remark,
                'Count' => $incomes->count(),
                'inc_exp1' => $incomes->where('remark','จ่ายค่าไฟ')->where('income','<',0)->sum('income')* (-1),
                'inc_exp2' => $incomes->where('remark','จ่ายค่าน้ำ')->where('income','<',0)->sum('income')* (-1),
                'inc_exp3' => $incomes->where('remark','จ่ายค่าอินเตอร์เน็ต')->where('income','<',0)->sum('income')* (-1),
                'inc_exp4' => $incomes->where('remark','จ่ายค่าจ้างคนงาน')->where('income','<',0)->sum('income')* (-1),
                'inc_exp5' => $incomes->where('remark','อื่นๆ')->where('income','<',0)->sum('income')* (-1),
                'inc_expSum' => $incomes->where('income','<',0)->sum('income')* (-1),
                'inc_revSum' => $incomes->where('income','>',0)->sum('income'),
                'mtn_sum' => $maintenances,
                'invoices' => $invoices,
                'les_sum' => $leases,
                'typ_doposit' => $invoices->where('net_pay','<',0)->sum('net_pay')* (-1),

            ];
            $pdf = PDF::loadView('print.print-report-income',['report'=> $report]);

            if ($request->get('between') == 'true') {

                return $pdf->stream('report-incomes' . $begin . ' - ' . $end . '.pdf');

            } elseif($request->get('between') == 'false') {

                return $pdf->stream('report-incomes' . Date::now() . '.pdf');
            }


        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function leaseReportPrint(Request $request)
    {
        try {
            $perPage = 10;
            if ($request->get('between') == 'true') {

                $begin = $request->get('begin');
                $end = $request->get('end');

                $leases = Lease::whereBetween('date_start', [$begin, $end])->whereIn('status', ['เช่าอยู่', 'แจ้งย้าย', 'ย้ายออก'])->latest()->get();


            } else {
                $leases = Lease::whereIn('status', ['เช่าอยู่', 'แจ้งย้าย', 'ย้ายออก'])->latest()->get();

            }

            $rooms = Room::latest()->get();

            $report = (object)[

                'leases' => $leases,

            ];
            $pdf = PDF::loadView('print.print-report-lease',['report'=> $report]);

            if ($request->get('between') == 'true') {

                return $pdf->stream('report-leases' . $begin . ' - ' . $end . '.pdf');

            } elseif($request->get('between') == 'false') {

                return $pdf->stream('report-leases' . Date::now() . '.pdf');
            }


        } catch (Exception $ex) {
            return $ex->getMessage();
        }

    }


    public function maintenanceReportPrint(Request $request)
    {
        try {
            $perPage = 10;
            if ($request->get('between') == 'true') {

                $begin = $request->get('begin');
                $end = $request->get('end');
                $maintenances = Maintenance::whereBetween('date', [$begin, $end])->latest()->get();

            } else {
                $maintenances = Maintenance::latest()->get();
            }

            $report = (object)[
                'maintenances' => $maintenances,
                'Count' => $maintenances->count(),
                'mnt_st1' => $maintenances->where('status', 'แจ้งซ่อม')->count(),
                'mnt_st2' => $maintenances->where('status', 'กำลังซ่อม')->count(),
                'mnt_st3' => $maintenances->where('status', 'ยกเลิกแจ้งซ่อม')->count(),
                'mnt_st4' => $maintenances->where('status', 'ซ่อมเสร็จแล้ว')->count(),
                'mtn_sumPrice' => $maintenances->sum('price'),

            ];
            $pdf = PDF::loadView('print.print-report-maintenance',['report'=> $report]);

            if ($request->get('between') == 'true') {

                return $pdf->stream('report-maintenances' . $begin . ' - ' . $end . '.pdf');

            } elseif($request->get('between') == 'false') {

                return $pdf->stream('report-maintenances' . Date::now() . '.pdf');
            }

        } catch (Exception $ex) {
            return $ex->getMessage();
        }

    }

    public function invoiceReportPrint(Request $request)
    {
        try {
            $begin = $request->get('begin');
            $end = $request->get('end');

            if ($request->get('between') == 'true') {

                $invoice = Invoice::whereBetween('date', [$begin, $end])->latest()->get();

            } else {

                $invoice = Invoice::latest()->get();
            }

            $report = (object)[
                'invoice' => $invoice,
                'begin' => $begin,
                'end' => $end
            ];

            $pdf = PDF::loadView('print.print-report-invoice',['report'=> $report]);

            if ($request->get('between') == 'true') {

                return $pdf->stream('report-invoices' . $begin . ' - ' . $end . '.pdf');

            } elseif($request->get('between') == 'false') {

                return $pdf->stream('report-invoices' . Date::now() . '.pdf');
            }

        } catch (Exception $ex) {
            return $ex->getMessage();
        }

    }

}
