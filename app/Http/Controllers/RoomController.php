<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Type;
use Image;

class RoomController extends Controller
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
            if(!empty($status)) {
                $room = Room::where('status',$status)->latest()->paginate($perPage);

            }elseif(!empty($search)){
                $room = Room::where('number', 'LIKE', "%$search%")
                    ->orWhere('building', 'LIKE', "%$search%")
                    ->latest()->paginate($perPage);

            }else{
                $room = Room::latest()->paginate($perPage);
            }
            $type = Type::latest()->paginate($perPage);
            return view('room.index',['navbarSeach' => 'room'], compact('room','type'));

        } catch (Exception $ex) {
            return $ex->getMessage();
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
            $type = Type::orderBy('price', 'asc')->get();
            return view('room.create',compact('type'));
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
            $room = Room::create($requestData);

            $path = public_path('storage/rooms');
            if (Storage::disk('public')->missing('rooms')) {
                Storage::disk('public')->makeDirectory('rooms');
            }

            if ($request->hasFile('photo1')) {
                $photo1 = $request->file('photo1');
                $photo1_name = $room->id . 'Photo1-' . time() . '.' . $photo1->getClientOriginalExtension();
                Image::make($photo1)->resize(1920, 960)->save($path . '/' . $photo1_name);
                $requestData['photo1'] = 'rooms/'.$photo1_name;
            }
            if ($request->hasFile('photo2')) {
                $photo2 = $request->file('photo2');
                $photo2_name = $room->id . 'Photo2-' . time() . '.' . $photo2->getClientOriginalExtension();
                Image::make($photo2)->resize(1920, 960)->save($path . '/' . $photo2_name);
                $requestData['photo2'] = 'rooms/'.$photo2_name;
            }
            if ($request->hasFile('photo3')) {
                $photo3 = $request->file('photo3');
                $photo3_name = $room->id . 'Photo3-' . time() . '.' . $photo3->getClientOriginalExtension();
                Image::make($photo3)->resize(1920, 960)->save($path . '/' . $photo3_name);
                $requestData['photo3'] = 'rooms/'.$photo3_name;
            }
            if ($request->hasFile('photo4')) {
                $photo4 = $request->file('photo4');
                $photo4_name = $room->id . 'Photo4-' . time() . '.' . $photo4->getClientOriginalExtension();
                Image::make($photo4)->resize(1920, 960)->save($path . '/' . $photo4_name);
                $requestData['photo4'] = 'rooms/'.$photo4_name;
            }

            $room = Room::findOrFail($room->id);
            $room->update($requestData);
            return redirect('room')->with('success', 'เพิ่มข้อมูลห้องเช่าเรียบร้อยแล้วคะ!');

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
            $room = Room::findOrFail($id);
            return view('room.show', compact('room'));
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
            $room = Room::findOrFail($id);
            $type = Type::orderBy('price', 'asc')->get();
            return view('room.edit', compact('room','type'));
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

            $path = public_path('storage/rooms');
            if (Storage::disk('public')->missing('rooms')) {
                Storage::disk('public')->makeDirectory('rooms');
            }

            if ($request->hasFile('photo1')) {
                if(Storage::exists('public/'.$request['photo1_old'])){
                    Storage::delete('public/'.$request['photo1_old']);
                }
                $photo1 = $request->file('photo1');
                $photo1_name = $id . 'Photo1-' . time() . '.' . $photo1->getClientOriginalExtension();
                Image::make($photo1)->resize(1920, 960)->save($path . '/' . $photo1_name);
                $requestData['photo1'] = 'rooms/'.$photo1_name;
            }
            if ($request->hasFile('photo2')) {
                if(Storage::exists('public/'.$request['photo2_old'])){
                    Storage::delete('public/'.$request['photo2_old']);
                }
                $photo2 = $request->file('photo2');
                $photo2_name = $id . 'Photo2-' . time() . '.' . $photo2->getClientOriginalExtension();
                Image::make($photo2)->resize(1920, 960)->save($path . '/' . $photo2_name);
                $requestData['photo2'] = 'rooms/'.$photo2_name;
            }
            if ($request->hasFile('photo3')) {
                if(Storage::exists('public/'.$request['photo3_old'])){
                    Storage::delete('public/'.$request['photo3_old']);
                }
                $photo3 = $request->file('photo3');
                $photo3_name = $id . 'Photo3-' . time() . '.' . $photo3->getClientOriginalExtension();
                Image::make($photo3)->resize(1920, 960)->save($path . '/' . $photo3_name);
                $requestData['photo3'] = 'rooms/'.$photo3_name;
            }
            if ($request->hasFile('photo4')) {
                if(Storage::exists('public/'.$request['photo4_old'])){
                    Storage::delete('public/'.$request['photo4_old']);
                }
                $photo4 = $request->file('photo4');
                $photo4_name = $id . 'Photo4-' . time() . '.' . $photo4->getClientOriginalExtension();
                Image::make($photo4)->resize(1920, 960)->save($path . '/' . $photo4_name);
                $requestData['photo4'] = 'rooms/'.$photo4_name;
            }
            $room = Room::findOrFail($id);
            $room->update($requestData);

            return redirect('room')->with('success', 'แก้ไขข้อมูลห้องเช่าเรียบร้อยแล้วคะ!');
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
        //     $room = Room::findOrFail($id);
        //     if(Storage::exists('public/'.$room ->photo1)){
        //         Storage::delete('public/'.$room ->photo1);
        //     }
        //     if(Storage::exists('public/'.$room ->photo2)){
        //         Storage::delete('public/'.$room ->photo2);
        //     }
        //     if(Storage::exists('public/'.$room ->photo3)){
        //         Storage::delete('public/'.$room ->photo3);
        //     }
        //     if(Storage::exists('public/'.$room ->photo4)){
        //         Storage::delete('public/'.$room ->photo4);
        //     }
        //     Room::destroy($id);
        //     return redirect('room')->with('success', 'ลบข้อมูลห้องเช่าเรียบร้อยแล้วคะ!');
        // } catch (Exception $ex) {
        //     return $ex->getMessage();
        // }
    }
}
