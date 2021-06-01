<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Income;
use App\User;
use App\Lease;
use App\Invoice;
use App\Maintenance;
use App\Webconfig;
use App\Room;
use App\Charts\ReportChart;
use Jenssegers\Date\Date;
Date::setLocale('th');

class ReportController extends Controller
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

    public function incomeReport(Request $request)
    {
        try {
            $perPage = 8;
            $begin = $request->get('begin');
            $end = $request->get('end');

            if ($request->get('between') == 'true' && Date::parse($begin)->format('Y') == Date::parse($end)->format('Y')) {

                $income = Income::whereBetween('date', [$begin, $end])->latest()->paginate($perPage);
                $incomes = Income::whereBetween('date', [$begin, $end])->latest()->get();
                $invoices = Invoice::whereBetween('date', [$begin, $end])->get();
                $leases = Lease::whereBetween('date_start', [$begin, $end])->where('status','!=','จอง')->sum('net_pay');
                $maintenances = Maintenance::whereBetween('date', [$begin, $end])->sum('price');

                $chart_inc_rev = Income::whereBetween('date', [$begin, $end])->where('income','>',0)
                    ->selectRaw('SUM(income) as income')
                    ->groupByRaw('Month(date)')
                    ->pluck('income');
                $chart_les_rev = Lease::whereBetween('date_start', [$begin, $end])->where('status','!=','จอง')->where('net_pay','>',0)
                    ->selectRaw('SUM(net_pay) as net_pay')
                    ->groupByRaw('Month(date_start)')
                    ->pluck('net_pay');
                $chart_inv_rev = Invoice::whereBetween('date', [$begin, $end])->where('net_pay','>',0)
                    ->selectRaw('SUM(net_pay) as net_pay')
                    ->groupByRaw('Month(date)')
                    ->pluck('net_pay');


                $chart_mtn_exp = Maintenance::whereBetween('date', [$begin, $end])->selectRaw('SUM(price) as price')
                    ->groupByRaw('Month(date)')
                    ->pluck('price');
                $chart_inc_exp = Income::whereBetween('date', [$begin, $end])->where('income','<',0)
                    ->selectRaw('SUM(income)*(-1) as income')
                    ->groupByRaw('Month(date)')
                    ->pluck('income');
                $chart_inv_exp = Invoice::whereBetween('date', [$begin, $end])->where('net_pay','<',0)
                    ->selectRaw('SUM(net_pay)*(-1) as net_pay')
                    ->groupByRaw('Month(date)')
                    ->pluck('net_pay');

                $array_inc_exp = array();
                $array_mtn_exp = array();
                $array_inv_exp = array();
                $count_mtn_exp = count($chart_mtn_exp);
                $count_inc_exp = count($chart_inc_exp);
                $count_inv_exp = count($chart_inv_exp);
                $arrayExp =array();

                $array_inc_rev = array();
                $array_les_rev = array();
                $array_inv_rev = array();
                $count_inc_rev = count($chart_inc_rev);
                $count_les_rev = count($chart_les_rev);
                $count_inv_rev = count($chart_inv_rev);
                $arrayRev =array();

                for ($i=0; $i <= 11; $i++) {
                    // รายจ่าย
                    if ($i < $count_mtn_exp) {
                        array_push($array_mtn_exp,$chart_mtn_exp[$i]);
                    }else {
                        array_push($array_mtn_exp,0);
                    }
                    if ($i < $count_inc_exp) {
                        array_push($array_inc_exp,$chart_inc_exp[$i]);
                    }else {
                        array_push($array_inc_exp,0);
                    }
                    if ($i < $count_inv_exp) {
                        array_push($array_inv_exp,$chart_inv_exp[$i]);
                    }else {
                        array_push($array_inv_exp,0);
                    }
                    // รายรับ
                    if ($i < $count_inc_rev) {
                        array_push($array_inc_rev,$chart_inc_rev[$i]);
                    }else {
                        array_push($array_inc_rev,0);
                    }
                    if ($i < $count_les_rev) {
                        array_push($array_les_rev,$chart_les_rev[$i]);
                    }else {
                        array_push($array_les_rev,0);
                    }
                    if ($i < $count_inv_rev) {
                        array_push($array_inv_rev,$chart_inv_rev[$i]);
                    }else {
                        array_push($array_inv_rev,0);
                    }
                }

                for ($i=0; $i <= 11; $i++) {

                    $arrayExp[$i] = $array_inc_exp[$i] + $array_mtn_exp[$i] + $array_inv_exp[$i];
                    $arrayRev[$i] = $array_inc_rev[$i] + $array_les_rev[$i] + $array_inv_rev[$i];
                }

                $labelsChart = array();
                for ($i=Date::parse($begin)->format('m'); $i <= Date::parse($end)->format('m'); $i++) {
                    switch ($i) {
                        case 1:
                            array_push($labelsChart,'ม.ค.');
                        break;
                        case 2:
                            array_push($labelsChart,'ก.พ.');
                        break;
                        case 3:
                            array_push($labelsChart,'มี.ค.');
                        break;
                        case 4:
                            array_push($labelsChart,'เม.ย.');
                        break;
                        case 5:
                            array_push($labelsChart,'พ.ค.');
                        break;
                        case 6:
                            array_push($labelsChart,'มิ.ย.');
                        break;
                        case 7:
                            array_push($labelsChart,'ก.ค.');
                        break;
                        case 8:
                            array_push($labelsChart,'ส.ค.');
                        break;
                        case 9:
                            array_push($labelsChart,'ก.ย.');
                        break;
                        case 10:
                            array_push($labelsChart,'ต.ค.');
                        break;
                        case 11:
                            array_push($labelsChart,'พ.ย.');
                        break;
                        case 12:
                            array_push($labelsChart,'ธ.ค.');
                        break;
                    }
                }

            } elseif ($request->get('between') == 'true' && Date::parse($begin)->format('Y') < Date::parse($end)->format('Y')) {

                $income = Income::whereBetween('date', [$begin, $end])->latest()->paginate($perPage);
                $incomes = Income::whereBetween('date', [$begin, $end])->latest()->get();
                $invoices = Invoice::whereBetween('date', [$begin, $end])->get();
                $leases = Lease::whereBetween('date_start', [$begin, $end])->where('status','!=','จอง')->sum('net_pay');
                $maintenances = Maintenance::whereBetween('date', [$begin, $end])->sum('price');

                $inc_rev_chart = Income::where('income','>',0)
                    ->selectRaw('SUM(income) as income, Year(date) as date')
                    ->groupByRaw('Year(date)')->get('income','date');
                $inc_rev_year_min = Income::where('income','>',0)->selectRaw('MIN(Year(date)) as date')->first();
                $inc_rev_year_min = isset($inc_rev_year_min->date) ? $inc_rev_year_min->date : Date::now()->format('Y');

                // รายรับตาราง invoice จากค่าเช่า
                $inv_rev_chart = Invoice::where('status','ชำระเงินแล้ว')->where('net_pay','>',0)
                    ->selectRaw('SUM(net_pay) as net_pay, Year(date) as date')
                    ->groupByRaw('Year(date)')->get('net_pay','date');
                $inv_rev_year_min = Invoice::where('status','ชำระเงินแล้ว')->where('net_pay','>',0)->selectRaw('MIN(Year(date)) as date')->first();
                $inv_rev_year_min = isset($inv_rev_year_min->date) ? $inv_rev_year_min->date : Date::now()->format('Y');

                // รายรับ เข้าอยู่ใหม่และจอง
                $les_rev_chart = Lease::where('status','!=','จอง')->where('net_pay','>',0)
                    ->selectRaw('SUM(net_pay) as net_pay, Year(date_start) as date_start')
                    ->groupByRaw('Year(date_start)')->get('net_pay','date_start');
                $les_rev_year_min = Lease::where('status','!=','จอง')->where('net_pay','>',0)->selectRaw('MIN(Year(date_start)) as date_start')->first();
                $les_rev_year_min = isset($les_rev_year_min->date_start) ? $les_rev_year_min->date_start : Date::now()->format('Y');

                $rev_year_min = $inc_rev_year_min < $les_rev_year_min ? $inc_rev_year_min : $les_rev_year_min;
                $rev_year_min = $rev_year_min < $inv_rev_year_min ? $rev_year_min : $inv_rev_year_min;

                //รายจ่าย
                $inc_exp_chart = Income::where('income','<',0)
                    ->selectRaw('SUM(income)*(-1) as income, Year(date) as date')
                    ->groupByRaw('Year(date)')
                    ->get('income','date');
                $inc_exp_year_min = Income::where('income','<',0)->selectRaw('MIN(Year(date)) as date')->first();
                $inc_exp_year_min = isset($inc_exp_year_min->date) ? $inc_exp_year_min->date : Date::now()->format('Y');

                $inv_exp_chart = Invoice::where('status','ชำระเงินแล้ว')->where('net_pay','<',0)
                    ->selectRaw('SUM(net_pay)*(-1) as net_pay, Year(date) as date')
                    ->groupByRaw('Year(date)')->get('net_pay','date');
                $inv_exp_year_min = Invoice::where('status','ชำระเงินแล้ว')->where('net_pay','<',0)->selectRaw('MIN(Year(date)) as date')->first();
                $inv_exp_year_min = isset($inv_exp_year_min->date) ? $inv_exp_year_min->date : Date::now()->format('Y');

                $mtn_exp_chart = Maintenance::selectRaw('SUM(price) as price, Year(date) as date')
                    ->groupByRaw('Year(date)')->get('price','date');
                $mtn_exp_year_min = Maintenance::selectRaw('MIN(Year(date)) as date')->first();
                $mtn_exp_year_min = isset($mtn_exp_year_min->date) ? $mtn_exp_year_min->date : Date::now()->format('Y');

                $exp_year_min = $mtn_exp_year_min < $inc_exp_year_min ? $mtn_exp_year_min : $inc_exp_year_min;
                $exp_year_min = $exp_year_min < $inv_exp_year_min ? $exp_year_min : $inv_exp_year_min;


                $year_min = $exp_year_min < $rev_year_min ? $exp_year_min : $rev_year_min;
                $year_max = Date::now()->format('Y');

                $labelsChart = array();
                for ($i = $year_min; $i <= $year_max; $i++) {
                    array_push($labelsChart,$i);

                }

                // ********* ร่ายรับ ********* //
                $inc_rev_array = array();
                $inv_rev_array = array();
                $les_rev_array = array();
                $x = 0; $xx = 0; $xxx = 0;
                for ($i = $year_min; $i <= $year_max; $i++) {

                    if ($x < count($inc_rev_chart)) {
                        if ($inc_rev_chart[$x]->date == $i) {
                            array_push($inc_rev_array,$inc_rev_chart[$x]->income);
                            $x =  $x + 1;
                        } else {
                            array_push($inc_rev_array,0);
                        }
                    }elseif (count($inc_rev_chart) == 0) {
                        array_push($inc_rev_array,0);
                    }else{
                        array_push($inc_rev_array,0);
                    }

                    if ($xx < count($inv_rev_chart)) {
                        if ($inv_rev_chart[$xx]->date == $i) {
                            array_push($inv_rev_array,$inv_rev_chart[$xx]->net_pay);
                            $xx =  $xx + 1;
                        } else {
                            array_push($inv_rev_array,0);
                        }
                    }elseif (count($inv_rev_chart) == 0) {
                        array_push($inv_rev_array,0);
                    }else{
                        array_push($inv_rev_array,0);
                    }

                    if ($xxx < count($les_rev_chart)) {
                        if ($les_rev_chart[$xxx]->date_start == $i) {
                            array_push($les_rev_array,$les_rev_chart[$xxx]->net_pay);
                            $xxx =  $xxx + 1;
                        } else {
                            array_push($les_rev_array,0);
                        }
                    }elseif (count($les_rev_chart) == 0) {
                        array_push($les_rev_array,0);
                    }else{
                        array_push($les_rev_array,0);
                    }
                }

                // ********* ร่ายจ่าย ********* //
                $inc_exp_array = array();
                $inv_exp_array = array();
                $mtn_exp_array = array();
                $ii = 0; $iii = 0; $iiii = 0;
                for ($i = $year_min; $i <= $year_max; $i++) {

                    if ($ii < count($inc_exp_chart)) {
                        if ($inc_exp_chart[$ii]->date == $i) {
                            array_push($inc_exp_array,$inc_exp_chart[$ii]->income);
                            $ii =  $ii + 1;
                        } else {
                            array_push($inc_exp_array,0);
                        }
                    }elseif (count($inc_exp_chart) == 0) {
                        array_push($inc_exp_array,0);
                    }else{
                        array_push($inc_exp_array,0);
                    }

                    if ($iii < count($inv_exp_chart)) {
                        if ($inv_exp_chart[$iii]->date == $i) {
                            array_push($inv_exp_array,$inv_exp_chart[$iii]->net_pay);
                            $iii =  $iii + 1;
                        } else {
                            array_push($inv_exp_array,0);
                        }
                    }elseif (count($inv_exp_chart) == 0) {
                        array_push($inv_exp_array,0);
                    }else{
                        array_push($inv_exp_array,0);
                    }

                    if ($iiii < count($mtn_exp_chart)) {
                        if ($mtn_exp_chart[$iiii]->date == $i) {
                            array_push($mtn_exp_array,$mtn_exp_chart[$iiii]->price);
                            $iiii =  $iiii + 1;
                        } else {
                            array_push($mtn_exp_array,0);
                        }
                    }elseif (count($mtn_exp_chart) == 0) {
                        array_push($mtn_exp_array,0);
                    }else{
                        array_push($mtn_exp_array,0);
                    }
                }
                $arrayExp =array();
                $arrayRev =array();
                for ($i=0; $i < count($labelsChart); $i++) {
                    $arrayExp[$i] = $inc_exp_array[$i] + $inv_exp_array[$i] + $mtn_exp_array[$i];
                    $arrayRev[$i] = $inc_rev_array[$i] + $inv_rev_array[$i] + $les_rev_array[$i];
                }
                $labelsChart = array();
                for ($i=Date::parse($begin)->format('Y'); $i <= Date::parse($end)->format('Y'); $i++) {

                    array_push($labelsChart,$i);
                }
            }else {
                $income = Income::latest()->paginate($perPage);
                $incomes = Income::latest()->get();
                $invoices = Invoice::latest()->get();
                $leases = Lease::where('status','!=','จอง')->sum('net_pay');
                $maintenances = Maintenance::sum('price');

                $inc_rev_chart = Income::where('income','>',0)
                    ->selectRaw('SUM(income) as income, Year(date) as date')
                    ->groupByRaw('Year(date)')->get('income','date');
                $inc_rev_year_min = Income::where('income','>',0)->selectRaw('MIN(Year(date)) as date')->first();
                $inc_rev_year_min = isset($inc_rev_year_min->date) ? $inc_rev_year_min->date : Date::now()->format('Y');

                // รายรับตาราง invoice จากค่าเช่า
                $inv_rev_chart = Invoice::where('status','ชำระเงินแล้ว')->where('net_pay','>',0)
                    ->selectRaw('SUM(net_pay) as net_pay, Year(date) as date')
                    ->groupByRaw('Year(date)')->get('net_pay','date');
                $inv_rev_year_min = Invoice::where('status','ชำระเงินแล้ว')->where('net_pay','>',0)->selectRaw('MIN(Year(date)) as date')->first();
                $inv_rev_year_min = isset($inv_rev_year_min->date) ? $inv_rev_year_min->date : Date::now()->format('Y');

                // รายรับ เข้าอยู่ใหม่และจอง
                $les_rev_chart = Lease::where('status','!=','จอง')->where('net_pay','>',0)
                    ->selectRaw('SUM(net_pay) as net_pay, Year(date_start) as date_start')
                    ->groupByRaw('Year(date_start)')->get('net_pay','date_start');
                $les_rev_year_min = Lease::where('status','!=','จอง')->where('net_pay','>',0)->selectRaw('MIN(Year(date_start)) as date_start')->first();
                $les_rev_year_min = isset($les_rev_year_min->date_start) ? $les_rev_year_min->date_start : Date::now()->format('Y');

                $rev_year_min = $inc_rev_year_min < $les_rev_year_min ? $inc_rev_year_min : $les_rev_year_min;
                $rev_year_min = $rev_year_min < $inv_rev_year_min ? $rev_year_min : $inv_rev_year_min;

                //รายจ่าย
                $inc_exp_chart = Income::where('income','<',0)
                    ->selectRaw('SUM(income)*(-1) as income, Year(date) as date')
                    ->groupByRaw('Year(date)')
                    ->get('income','date');
                $inc_exp_year_min = Income::where('income','<',0)->selectRaw('MIN(Year(date)) as date')->first();
                $inc_exp_year_min = isset($inc_exp_year_min->date) ? $inc_exp_year_min->date : Date::now()->format('Y');

                $inv_exp_chart = Invoice::where('status','ชำระเงินแล้ว')->where('net_pay','<',0)
                    ->selectRaw('SUM(net_pay)*(-1) as net_pay, Year(date) as date')
                    ->groupByRaw('Year(date)')->get('net_pay','date');
                $inv_exp_year_min = Invoice::where('status','ชำระเงินแล้ว')->where('net_pay','<',0)->selectRaw('MIN(Year(date)) as date')->first();
                $inv_exp_year_min = isset($inv_exp_year_min->date) ? $inv_exp_year_min->date : Date::now()->format('Y');

                $mtn_exp_chart = Maintenance::selectRaw('SUM(price) as price, Year(date) as date')
                    ->groupByRaw('Year(date)')->get('price','date');
                $mtn_exp_year_min = Maintenance::selectRaw('MIN(Year(date)) as date')->first();
                $mtn_exp_year_min = isset($mtn_exp_year_min->date) ? $mtn_exp_year_min->date : Date::now()->format('Y');

                $exp_year_min = $mtn_exp_year_min < $inc_exp_year_min ? $mtn_exp_year_min : $inc_exp_year_min;
                $exp_year_min = $exp_year_min < $inv_exp_year_min ? $exp_year_min : $inv_exp_year_min;

                $year_min = $exp_year_min < $rev_year_min ? $exp_year_min : $rev_year_min;
                $year_max = Date::now()->format('Y');

                $labelsChart = array();
                for ($i = $year_min; $i <= $year_max; $i++) {
                    array_push($labelsChart,$i);

                }

                // ********* ร่ายรับ ********* //
                $inc_rev_array = array();
                $inv_rev_array = array();
                $les_rev_array = array();
                $x = 0; $xx = 0; $xxx = 0;
                for ($i = $year_min; $i <= $year_max; $i++) {

                    if ($x < count($inc_rev_chart)) {
                        if ($inc_rev_chart[$x]->date == $i) {
                            array_push($inc_rev_array,$inc_rev_chart[$x]->income);
                            $x =  $x + 1;
                        } else {
                            array_push($inc_rev_array,0);
                        }
                    }elseif (count($inc_rev_chart) == 0) {
                        array_push($inc_rev_array,0);
                    }else{
                        array_push($inc_rev_array,0);
                    }

                    if ($xx < count($inv_rev_chart)) {
                        if ($inv_rev_chart[$xx]->date == $i) {
                            array_push($inv_rev_array,$inv_rev_chart[$xx]->net_pay);
                            $xx =  $xx + 1;
                        } else {
                            array_push($inv_rev_array,0);
                        }
                    }elseif (count($inv_rev_chart) == 0) {
                        array_push($inv_rev_array,0);
                    }else{
                        array_push($inv_rev_array,0);
                    }

                    if ($xxx < count($les_rev_chart)) {
                        if ($les_rev_chart[$xxx]->date_start == $i) {
                            array_push($les_rev_array,$les_rev_chart[$xxx]->net_pay);
                            $xxx =  $xxx + 1;
                        } else {
                            array_push($les_rev_array,0);
                        }
                    }elseif (count($les_rev_chart) == 0) {
                        array_push($les_rev_array,0);
                    }else{
                        array_push($les_rev_array,0);
                    }
                }

                // ********* ร่ายจ่าย ********* //
                $inc_exp_array = array();
                $inv_exp_array = array();
                $mtn_exp_array = array();
                $ii = 0; $iii = 0; $iiii = 0;
                for ($i = $year_min; $i <= $year_max; $i++) {

                    if ($ii < count($inc_exp_chart)) {
                        if ($inc_exp_chart[$ii]->date == $i) {
                            array_push($inc_exp_array,$inc_exp_chart[$ii]->income);
                            $ii =  $ii + 1;
                        } else {
                            array_push($inc_exp_array,0);
                        }
                    }elseif (count($inc_exp_chart) == 0) {
                        array_push($inc_exp_array,0);
                    }else{
                        array_push($inc_exp_array,0);
                    }

                    if ($iii < count($inv_exp_chart)) {
                        if ($inv_exp_chart[$iii]->date == $i) {
                            array_push($inv_exp_array,$inv_exp_chart[$iii]->net_pay);
                            $iii =  $iii + 1;
                        } else {
                            array_push($inv_exp_array,0);
                        }
                    }elseif (count($inv_exp_chart) == 0) {
                        array_push($inv_exp_array,0);
                    }else{
                        array_push($inv_exp_array,0);
                    }

                    if ($iiii < count($mtn_exp_chart)) {
                        if ($mtn_exp_chart[$iiii]->date == $i) {
                            array_push($mtn_exp_array,$mtn_exp_chart[$iiii]->price);
                            $iiii =  $iiii + 1;
                        } else {
                            array_push($mtn_exp_array,0);
                        }
                    }elseif (count($mtn_exp_chart) == 0) {
                        array_push($mtn_exp_array,0);
                    }else{
                        array_push($mtn_exp_array,0);
                    }
                }

                $arrayExp =array();
                $arrayRev =array();
                for ($i=0; $i < count($labelsChart); $i++) {
                    $arrayExp[$i] = $inc_exp_array[$i] + $inv_exp_array[$i] + $mtn_exp_array[$i];
                    $arrayRev[$i] = $inc_rev_array[$i] + $inv_rev_array[$i] + $les_rev_array[$i];
                }
            }

            $inc_remark = Income::select('remark')->latest()->groupBy('remark')->get();
            $inc_remark_rev = Income::where('income','<',0)
                ->selectRaw('SUM(income)*(-1) as income')
                ->selectRaw('remark')
                ->groupByRaw('remark')
                ->get();
            $inc_remark_exp = Income::where('income','>',0)
                ->selectRaw('SUM(income) as income')
                ->selectRaw('remark')
                ->groupByRaw('remark')
                ->get();

            $report = (object)[
                'income' => $income,
                'incomes' => $incomes,
                'inc_remark' => $inc_remark,
                'Count' => $incomes->count(),
                'inc_expSum' => $incomes->where('income','<',0)->sum('income') * (-1),
                'inc_revSum' => $incomes->where('income','>',0)->sum('income'),
                'mtn_sum' => $maintenances,
                'invoices' => $invoices,
                'inv_exp' => $invoices->where('status','ชำระเงินแล้ว')->where('net_pay','<',0)->sum('net_pay')* (-1),
                'inv_rev' => $invoices->where('status','ชำระเงินแล้ว')->where('net_pay','>',0)->sum('net_pay'),
                'les_sum' => $leases,
                'inc_remark_rev' => $inc_remark_rev,
                'inc_remark_exp' => $inc_remark_exp
            ];



            $chart = new ReportChart;
            $chart->labels($labelsChart);
            $chart->dataset('รายรับ','bar',$arrayRev)
                ->color("rgba(22,160,133, 1.0)")
                ->backgroundcolor("rgba(22,160,133, 0.2)");
            $chart->dataset('รายจ่าย','bar',$arrayExp) //bar line
                ->color("rgba(255, 99, 132, 1.0)")
                ->backgroundcolor("rgba(255, 99, 132, 0.2)");

            return view('income.index',compact('report','chart'));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function leaseReport(Request $request)
    {
        try {
            $perPage = 8;
            if ($request->get('between') == 'true') {

                $begin = $request->get('begin');
                $end = $request->get('end');

                $lease = Lease::whereBetween('date_start', [$begin, $end])->whereIn('status', ['เช่าอยู่', 'แจ้งย้าย', 'ย้ายออก'])->latest()->paginate($perPage);
                $leases = Lease::whereBetween('date_start', [$begin, $end])->whereIn('status', ['เช่าอยู่', 'แจ้งย้าย', 'ย้ายออก'])->latest()->get();


            } else {
                $lease = Lease::whereIn('status', ['เช่าอยู่', 'แจ้งย้าย', 'ย้ายออก'])->latest()->paginate($perPage);
                $leases = Lease::whereIn('status', ['เช่าอยู่', 'แจ้งย้าย', 'ย้ายออก'])->latest()->get();

            }

            $rooms = Room::latest()->get();

            $report = (object)[
                'lease' => $lease,
                'Count' => $leases->count(),
                'rm_count' => $rooms->count(),
                'rm_st1' => $rooms->where('status', 'ว่าง')->count(),
                'rm_st2' => $rooms->where('status', 'จอง')->count(),
                'rm_st3' => $rooms->where('status', 'เช่า')->count(),
                'rm_st4' => $rooms->where('status', 'ปรับปรุง')->count(),
                'les_st1' => $leases->where('status','เช่าอยู่')->count(),
                'les_st2' => $leases->where('status','แจ้งย้าย')->count(),
                'les_st3' => $leases->where('status','ย้ายออก')->count(),

            ];
            return view('income.index', compact('report'));

        } catch (Exception $ex) {
            return $ex->getMessage();
        }

    }

    public function maintenanceReport(Request $request)
    {
        try {
            $perPage = 8;
            if ($request->get('between') == 'true') {

                $begin = $request->get('begin');
                $end = $request->get('end');
                $maintenance = Maintenance::whereBetween('date', [$begin, $end])->latest()->paginate($perPage);
                $maintenances = Maintenance::whereBetween('date', [$begin, $end])->latest()->get();

            } else {
                $maintenance = Maintenance::latest()->paginate($perPage);
                $maintenances = Maintenance::latest()->get();
            }

            $report = (object)[
                'maintenance' => $maintenance,
                'maintenances' => $maintenances,
                'Count' => $maintenances->count(),
                'mnt_st1' => $maintenances->where('status', 'แจ้งซ่อม')->count(),
                'mnt_st2' => $maintenances->where('status', 'กำลังซ่อม')->count(),
                'mnt_st3' => $maintenances->where('status', 'ยกเลิกแจ้งซ่อม')->count(),
                'mnt_st4' => $maintenances->where('status', 'ซ่อมเสร็จแล้ว')->count(),
                'mtn_sumPrice' => $maintenances->sum('price'),

            ];
            return view('income.index', compact('report'));

        } catch (Exception $ex) {
            return $ex->getMessage();
        }

    }

    public function invoiceReport(Request $request)
    {
        try {
            $perPage = 8;
            if ($request->get('between') == 'true') {

                $begin = $request->get('begin');
                $end = $request->get('end');

                $invoice = Invoice::whereBetween('date', [$begin, $end])->latest()->paginate($perPage);
                $invoices = Invoice::whereBetween('date', [$begin, $end])->latest()->get();

            } else {
                $invoice = Invoice::latest()->paginate($perPage);
                $invoices = Invoice::latest()->get();
            }

            $report = (object)[
                'invoice' => $invoice,
                'invoices' => $invoices,
                'Count' => $invoices->count(),
                'meter_wtp' => $invoices->sum('meter_wtp'),
                'meter_ptp' => $invoices->sum('meter_ptp'),
                'meter_wtp' => $invoices->sum('meter_wtp'),
                'typ_centric' => $invoices->sum('typ_centric'),
                'typ_wifi' => $invoices->sum('typ_wifi'),
                'typ_vehicle' => $invoices->sum('typ_vehicle'),
                'typ_mulct' => $invoices->sum('typ_mulct'),
                'les_price' => $invoices->sum('les_price'),
                'net_pay' => $invoices->sum('net_pay'),
            ];

            return view('income.index', compact('report'));

        } catch (Exception $ex) {
            return $ex->getMessage();
        }

    }

            // $borderColors = [
            //     "rgba(255, 99, 132, 1.0)",
            //     "rgba(22,160,133, 1.0)",
            //     "rgba(255, 205, 86, 1.0)",
            //     "rgba(51,105,232, 1.0)",
            //     "rgba(244,67,54, 1.0)",
            //     "rgba(34,198,246, 1.0)",
            //     "rgba(153, 102, 255, 1.0)",
            //     "rgba(255, 159, 64, 1.0)",
            //     "rgba(233,30,99, 1.0)",
            //     "rgba(205,220,57, 1.0)"
            // ];
            // $fillColors = [
            //     "rgba(255, 99, 132, 0.2)",
            //     "rgba(22,160,133, 0.2)",
            //     "rgba(255, 205, 86, 0.2)",
            //     "rgba(51,105,232, 0.2)",
            //     "rgba(244,67,54, 0.2)",
            //     "rgba(34,198,246, 0.2)",
            //     "rgba(153, 102, 255, 0.2)",
            //     "rgba(255, 159, 64, 0.2)",
            //     "rgba(233,30,99, 0.2)",
            //     "rgba(205,220,57, 0.2)"
            // ];

}
