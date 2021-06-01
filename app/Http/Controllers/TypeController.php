<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class TypeController extends Controller
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
        // try {
        //     $perPage = 10;
        //     $type = Type::latest()->paginate($perPage);
        //     return view('type.index', compact('type'));
        // } catch (Exception $ex) {
        //     return $ex->getMessage();
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        try {
            return view('type.create');
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
            $type = Type::create($requestData);

            $path = public_path('storage/types');
            if (Storage::disk('public')->missing('types')) {
                Storage::disk('public')->makeDirectory('types');
            }

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photo_name = $type->id . 'Photo' . time() . '.' . $photo->getClientOriginalExtension();
                Image::make($photo)->resize(350, 400)->save($path . '/' . $photo_name);
                $requestData['photo'] = 'types/'.$photo_name;
            }

            $type = Type::findOrFail($type->id);
            $type->update($requestData);

            return redirect('type')->with('success', 'เพิ่มข้อมูลประเภทห้องเรียบร้อยแล้วคะ!');

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
            $type = Type::findOrFail($id);
            return view('type.show', compact('type'));
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
            $type = Type::findOrFail($id);
            return view('type.edit', compact('type'));
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

            $path = public_path('storage/types');
            if (Storage::disk('public')->missing('types')) {
                Storage::disk('public')->makeDirectory('types');
            }

            if ($request->hasFile('photo')) {
                if(Storage::exists('public/'.$request['photo_old'])){
                    Storage::delete('public/'.$request['photo_old']);
                }
                $photo = $request->file('photo');
                $photo_name = $id . 'Photo' . time() . '.' . $photo->getClientOriginalExtension();
                Image::make($photo)->resize(600, 800)->save($path . '/' . $photo_name);
                $requestData['photo'] = 'types/'.$photo_name;
            }
            $type = Type::findOrFail($id);
            $type->update($requestData);
            return redirect('type')->with('success', 'แก้ไขข้อมูลประเภทห้องเรียบร้อยแล้วคะ!');
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
        //     $type = Type::findOrFail($id);
        //     if(Storage::exists('public/'.$type->photo)){
        //         Storage::delete('public/'.$type->photo);
        //     }
        //     Type::destroy($id);
        //     return redirect('type')->with('success', 'ลบข้อมูลประเภทห้องเรียบร้อยแล้วคะ!');
        // } catch (Exception $ex) {
        //     return $ex->getMessage();
        // }
    }
}
