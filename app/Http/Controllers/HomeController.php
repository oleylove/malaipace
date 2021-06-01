<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Webconfig;
use App\Room;
use App\Lease;
use App\Maintenance;
use App\Income;
use App\Invoice;
use App\User;

use App\Charts\ReportChart;

use Jenssegers\Date\Date;
Date::setLocale('th');

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $wcfg = Webconfig::first();
            if(Auth::user()->role === "admin"){
                return redirect('dashboard');

            }elseif(Auth::user()->role === "guest"){

                switch (Auth::user()->status) {
                    case 'สมาชิกใหม่':
                        return redirect('type-grid');
                    break;
                    case 'สมาชิกจอง':
                        return redirect('status-booking');
                    break;
                    case 'สมาชิกออกแล้ว':
                        return redirect('type-grid');
                    break;
                    default:
                        return redirect('user-profile');
                    break;
                }
            }else{
                return redirect('/');
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function apartment()
    {
        try {
            $wcfg = Webconfig::first();
            if(Auth::user()){
                return view('home',compact('wcfg'));
            }else{
                return redirect('/');
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function dashboard()
    {
        try {
            if(Auth::user()->role == "admin"){

                $room = Room::latest()->get();
                $rm_blank = 0;
                $rm_lease = 0;
                foreach ($room as $item) {
                    if($item->status == 'ว่าง'){
                        $rm_blank  = $rm_blank + 1;
                    }
                    if($item->status == 'เช่า'){
                        $rm_lease  = $rm_lease + 1;
                    }
                }

                $maintenance = Maintenance::latest()->get();
                $mnt_exp = $maintenance->sum('price');
                $mnt_count = $maintenance->count();
                $mnt_inform = 0;
                foreach ($maintenance as $item) {
                    if($item->status == 'แจ้งซ่อม' || $item->status == 'กำลังซ่อม'){
                        $mnt_inform  = $mnt_inform + 1;
                    }
                }


                $lease = Lease::latest()->get();
                $leaseCount = $lease->where('status','เช่าอยู่')->count();
                $les_rev = $lease->sum('net_pay');
                $booking = 0;
                $contract = 0;
                $checkout = 0;
                foreach ($lease as $item) {
                    if($item->status == 'จอง'){
                        $booking  = $booking + 1;
                    }
                    if($item->status == 'ยืนยันจอง'){
                        $contract  = $contract + 1;
                    }
                    if($item->status == 'แจ้งย้าย' || $item->status == 'ยืนยันแจ้งย้าย'){
                        $checkout  = $checkout + 1;
                    }
                }


                $invoice = Invoice::where('status','รอตรวจสอบ')->count();
                $inv_rev = Invoice::where('status','ชำระเงินแล้ว')->where('net_pay', '>', 0)->sum('net_pay');
                $inc_rev = Income::where('income', '>', 0)->sum('income');

                $inv_exp = Invoice::where('status','ชำระเงินแล้ว')->where('net_pay', '<', 0)->sum('net_pay');
                $inc_exp = Income::where('income', '<', 0)->sum('income') * (-1);

                $user = User::count();

                $revSum = $inc_rev + $inv_rev + $les_rev;
                $expSum = $inv_exp + $mnt_exp + $inc_exp;

                $dashboard = (object)
                [
                    'revSum' => $revSum,
                    'expSum' => $expSum,
                    'booking' => $booking,
                    'contract' => $contract,
                    'checkout' => $checkout,
                    'mnt_count' => $mnt_count,
                    'mnt_inform' => $mnt_inform,
                    'invoice' => $invoice,
                    'rm_blank' => $rm_blank,
                    'rm_lease' => $rm_lease,
                    'user' => $user,
                    'leaseCount' => $leaseCount
                ];

                // FOR CHART
                // รายรับตาราง income
                $chart_inc_rev = Income::where('income','>',0)
                    ->selectRaw('SUM(income) as income, Month(date) as date')
                    ->groupByRaw('Month(date)')->get('income','date');
                // รายรับตาราง invoice จากค่าเช่า
                $chart_inv_rev = Invoice::where('status','ชำระเงินแล้ว')->where('net_pay','>',0)
                    ->selectRaw('SUM(net_pay) as net_pay, Month(date) as date')
                    ->groupByRaw('Month(date)')->get('net_pay','date');
                // รายรับ การจอง
                $chart_les_rev = Lease::where('status','!=','จอง')->where('net_pay','>',0)
                    ->selectRaw('SUM(net_pay) as net_pay, Month(date_start) as date_start')
                    ->groupByRaw('Month(date_start)')->get('net_pay','date_start');



                //รายจ่ายจาก income
                $chart_inc_exp = Income::where('income','<',0)
                    ->selectRaw('SUM(income)*(-1) as income, Month(date) as date')
                    ->groupByRaw('Month(date)')->get('income','date');
                // รายจ่ายจาก คืนเงินประกัน
                $chart_inv_exp = Invoice::where('status','ชำระเงินแล้ว')->where('net_pay','<',0)
                    ->selectRaw('SUM(net_pay)*(-1) as net_pay, Month(date) as date')
                    ->groupByRaw('Month(date)')->get('net_pay','date');
                // รายจ่าย จากซ่อมบำรุง
                $chart_mtn_exp = Maintenance::selectRaw('SUM(price) as price, Month(date) as date')
                    ->groupByRaw('Month(date)')->get('price','date');

                $inc_rev_month_array = array();
                $inv_rev_month_array = array();
                $les_rev_month_array = array();
                $a = 0; $aa = 0; $aaa = 0;
                for ($i = 1; $i <= 12; $i++) {

                    if ($a < count($chart_inc_rev)) {
                        if ($chart_inc_rev[$a]->date == $i) {
                            array_push($inc_rev_month_array,$chart_inc_rev[$a]->income);
                            $a =  $a + 1;
                        } else {
                            array_push($inc_rev_month_array,0);
                        }

                    }elseif (count($chart_inc_rev) == 0) {
                        array_push($inc_rev_month_array,0);
                    }else{
                        array_push($inc_rev_month_array,0);
                    }

                    if ($aa < count($chart_inv_rev)) {
                        if ($chart_inv_rev[$aa]->date == $i) {
                            array_push($inv_rev_month_array,$chart_inv_rev[$aa]->net_pay);
                            $aa =  $aa + 1;
                        } else {
                            array_push($inv_rev_month_array,0);
                        }
                    }elseif (count($chart_inv_rev) == 0) {
                        array_push($inv_rev_month_array,0);
                    }else{
                        array_push($inv_rev_month_array,0);
                    }

                    if ($aaa < count($chart_les_rev)) {
                        if ($chart_les_rev[$aaa]->date_start == $i) {
                            array_push($les_rev_month_array,$chart_les_rev[$aaa]->net_pay);
                            $aaa =  $aaa + 1;
                        } else {
                            array_push($les_rev_month_array,0);
                        }
                    }elseif (count($chart_les_rev) == 0) {
                        array_push($les_rev_month_array,0);
                    }else{
                        array_push($les_rev_month_array,0);
                    }
                }

                $inc_exp_month_array = array();
                $inv_exp_month_array = array();
                $mtn_exp_month_array = array();
                $b = 0; $bb = 0; $bbb = 0;
                for ($i = 1; $i <= 12; $i++) {

                    if ($b < count($chart_inc_exp)) {
                        if ($chart_inc_exp[$b]->date == $i) {
                            array_push($inc_exp_month_array,$chart_inc_exp[$b]->income);
                            $b =  $b + 1;
                        } else {
                            array_push($inc_exp_month_array,0);
                        }

                    }elseif (count($chart_inc_exp) == 0) {
                        array_push($inc_exp_month_array,0);
                    }else{
                        array_push($inc_exp_month_array,0);
                    }

                    if ($bb < count($chart_inv_exp)) {
                        if ($chart_inv_exp[$bb]->date == $i) {
                            array_push($inv_exp_month_array,$chart_inv_exp[$bb]->net_pay);
                            $bb =  $bb + 1;
                        } else {
                            array_push($inv_exp_month_array,0);
                        }
                    }elseif (count($chart_inv_exp) == 0) {
                        array_push($inv_exp_month_array,0);
                    }else{
                        array_push($inv_exp_month_array,0);
                    }

                    if ($bbb < count($chart_mtn_exp)) {
                        if ($chart_mtn_exp[$bbb]->date == $i) {
                            array_push($mtn_exp_month_array,$chart_mtn_exp[$bbb]->price);
                            $bbb =  $bbb + 1;
                        } else {
                            array_push($mtn_exp_month_array,0);
                        }
                    }elseif (count($chart_mtn_exp) == 0) {
                        array_push($mtn_exp_month_array,0);
                    }else{
                        array_push($mtn_exp_month_array,0);
                    }
                }
                $arrayExpMonth =array();
                $arrayRevMonth =array();
                for ($i=0; $i <= 11; $i++) {
                    $arrayExpMonth[$i] = $inc_rev_month_array[$i] + $inv_rev_month_array[$i] + $les_rev_month_array[$i];
                    $arrayRevMonth[$i] = $inc_exp_month_array[$i] + $inv_exp_month_array[$i] + $mtn_exp_month_array[$i];
                }


                $chartMonth = new ReportChart;
                $chartMonth->labels(['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']);
                $chartMonth->dataset('รายรับ','bar',$arrayExpMonth)
                ->color("rgba(22,160,133, 1.0)")
                // ->backgroundcolor("transparent");
                ->backgroundcolor("rgba(22,160,133, 0.2)");
                $chartMonth->dataset('รายจ่าย','bar',$arrayRevMonth)
                ->color("rgba(255, 99, 132, 1.0)")
                // ->backgroundcolor("transparent");
                ->backgroundcolor("rgba(255, 99, 132, 0.2)");



                // ********************************************************************************** //
                // ********************************* CHART YEAR ************************************ //
                // ********************************************************************************** //
                // รายรับตาราง income
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
                $labal_year_array = array();
                for ($i = $year_min; $i <= $year_max; $i++) {
                    array_push($labal_year_array,$i);

                }

                // ************************** //
                // ********* ร่ายรับ ********* //
                // ************************** //
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
                // ************************** //
                // ********* ร่ายจ่าย ********* //
                // ************************** //
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
                for ($i=0; $i < count($labal_year_array); $i++) {
                    $arrayExp[$i] = $inc_exp_array[$i] + $inv_exp_array[$i] + $mtn_exp_array[$i];
                    $arrayRev[$i] = $inc_rev_array[$i] + $inv_rev_array[$i] + $les_rev_array[$i];
                }
                $chartYear = new ReportChart;
                $chartYear->labels($labal_year_array);
                $chartYear->dataset('รายรับ','line',$arrayRev)
                    ->color("rgba(22,160,133, 1.0)")
                    // ->backgroundcolor("rgba(22,160,133, 0.2)");
                    ->backgroundcolor("transparent");

                $chartYear->dataset('รายจ่าย','line',$arrayExp)
                    ->color("rgba(255, 99, 132, 1.0)")
                    // ->backgroundcolor("rgba(255, 99, 132, 0.2)");
                    ->backgroundcolor("transparent");

                return view("admin.dashboard", compact('dashboard','chartMonth','chartYear'));
            }else{
                return redirect('/');
            }
        } catch (Exception $ex) {

            return $ex->getMessage();
        }
    }
    public function errorNoPage()
    {
        return view('errors.404');
    }

}
