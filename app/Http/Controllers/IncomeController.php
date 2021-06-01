<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Income;
use App\Lease;
use App\Invoice;
use App\Maintenance;
use App\Webconfig;

use Jenssegers\Date\Date;
Date::setLocale('th');


class IncomeController extends Controller
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
    // public function index(Request $request)
    // {
    //     try {
    //     } catch (Exception $ex) {
    //         return $ex->getMessage();
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // try {
        //     return view('income.create');
        // } catch (\Exception $e) {
        //     return $e->getMessage();
        // }
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
            if ($requestData['remark_item'] && $requestData['remark_new']) {
                return redirect()->back()->with('fail', 'กรุณาเลือก หรือ พิมหมายเหตุใหม่คะ!');

            } elseif(empty($requestData['remark_item']) && empty($requestData['remark_new'])) {
                return redirect()->back()->with('fail', 'กรุณาเลือก หรือ พิมหมายเหตุใหม่คะ!');

            }else {
                if ($requestData['remark_item']) {
                    $requestData['remark'] = $requestData['remark_item'];
                }
                if ($requestData['remark_new']) {
                    $requestData['remark'] = $requestData['remark_new'];
                }
                if ($requestData['type'] == 'รายจ่าย') {
                    $requestData['income'] = $requestData['income'] * -1;
                }
                $requestData['date'] = get_Ymd(Date::now());
                Income::create($requestData);
                return redirect()->back()->with('success', 'เพิ่มรายการบัญชีเรียบร้อยแล้วคะ!');
            }

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
        // try {
        //     $income = Income::findOrFail($id);
        //     return view('income.show', compact('income'));

        // } catch (Exception $ex) {
        //     return $ex->getMessage();
        // }
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
        // try {
        //     $income = Income::findOrFail($id);
        //     return view('income.edit', compact('income'));
        // } catch (Exception $ex) {
        //     return $ex->getMessage();
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        try {
            $requestData = $request->all();
            $income = Income::findOrFail($requestData['id']);
            if ($requestData['remark_new']) {
                $requestData['remark'] = $requestData['remark_new'];
            }else {
                $requestData['remark'] = $requestData['remark_item'];
            }
            if ($requestData['type'] == 'รายจ่าย') {
                $requestData['income'] = $requestData['income'] * -1;
            }
            $requestData['updated_at'] = Date::now();
            $income->update($requestData);
            return redirect()->back()->with('success', 'แก้ไขรายการบัญชีเรียบร้อยแล้วคะ!');

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
        //     Income::destroy($id);
        //     return redirect('income')->with('flash_message', 'Income deleted!');
        // } catch (Exception $ex) {
        //     return $ex->getMessage();
        // }
    }

}
