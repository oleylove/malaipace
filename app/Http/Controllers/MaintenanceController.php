<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Maintenance;
use Illuminate\Http\Request;
use App\Room;
use Jenssegers\Date\Date;
Date::setLocale('th');

class MaintenanceController extends Controller
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
            $status = $request->get('status');
            $search = $request->get('search');
            $perPage = 8;

            if (!empty($status)) {
                $maintenance = Maintenance::where('status', $status)->latest()->paginate($perPage);
                $maintenanceCount = Maintenance::where('status', $status)->count();
            } elseif(!empty($search)) {
                $maintenance = Maintenance::where('detail', 'LIKE', "%$search%")
                    ->latest()->paginate($perPage);
                $maintenanceCount = Maintenance::where('detail', 'LIKE', "%$search%")->count();
            }else {

                $maintenance = Maintenance::latest()->paginate($perPage);
                $maintenanceCount = Maintenance::count();
            }

            return view('maintenance.index',['navbarSeach' => 'maintenance'], compact('maintenance','maintenanceCount'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        try {
            return view('maintenance.create');
        } catch (\Exception $e) {
            return $e->getMessage();
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
            if ($requestData['number'] && $requestData['building']) {
                $room = Room::where('number', $requestData['number'])
                    ->where('building', $requestData['building'])->first();
                    if ($room) {
                        $requestData['rm_id'] = $room->id;
                    } else {
                        $requestData['rm_id'] = NULL;
                    }
            } else {
                $requestData['rm_id'] = NULL;
            }
            $requestData['date'] = get_Ymd(Date::now());
            Maintenance::create($requestData);

            return redirect('maintenance')->with('success', 'บันทึกข้อมูลแจ้งซ่อมเรียบร้อยแล้วคะ!');

        } catch (\Exception $e) {

            return $e->getMessage();

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

            $maintenance = Maintenance::findOrFail($id);

            return view('maintenance.show', compact('maintenance'));

        } catch (\Exception $e) {

             return $e->getMessage();

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

            $maintenance = Maintenance::findOrFail($id);

            return view('maintenance.edit', compact('maintenance'));

        } catch (\Exception $e) {

             return $e->getMessage();

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

            $maintenance = Maintenance::findOrFail($id);
            $maintenance->update($requestData);

            if ($requestData['Get_Notified'] == 'รับแจ้ง') {
                return redirect()->back()->with('success', 'รับเรื่องการแจ้งเซ่อมบำรุงเรียบร้อยแล้วคะ!');
            } else {
                return redirect()->back()->with('success', 'แก้ไขข้อมูลแจ้งซ่อมเรียบร้อยแล้วคะ!');
            }

        } catch (\Exception $e) {

            return $e->getMessage();

        }
    }

    public function confirm(Request $request)
    {
        try {
            $requestData = $request->all();
            $requestData['status'] = 'ซ่อมเสร็จแล้ว';
            $requestData['date_done'] = Date::now();
            $requestData['updated_at'] = Date::now();
            $maintenance = Maintenance::findOrFail($requestData['id']);
            $maintenance->update($requestData);

            // return redirect('maintenance')->with('success', 'ยืนยันการซ่อมเรียบร้อยแล้วคะ!');
            return redirect()->back()->with('success', 'ยืนยันการซ่อมเรียบร้อยแล้วคะ!');

        } catch (\Exception $e) {

            return $e->getMessage();

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
        try {

            // Maintenance::destroy($id);

            // return redirect('maintenance')->with('flash_message', 'Maintenance deleted!');

        } catch (\Exception $e) {

            return $e->getMessage();

        }
    }
}
