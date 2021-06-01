<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Notice;
use Image;
use Jenssegers\Date\Date;
Date::setLocale('th');

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $notice = Notice::where('date', 'LIKE', "%$keyword%")
                ->orWhere('detail', 'LIKE', "%$keyword%")
                ->orWhere('photo', 'LIKE', "%$keyword%")
                ->orWhere('file', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
            $noticeCount = Notice::where('date', 'LIKE', "%$keyword%")
                ->orWhere('detail', 'LIKE', "%$keyword%")
                ->orWhere('photo', 'LIKE', "%$keyword%")
                ->orWhere('file', 'LIKE', "%$keyword%")
                ->count();

        } else {
            $notice = Notice::latest()->paginate($perPage);
            $noticeCount = Notice::count();
        }
        return view('notice.index', compact('notice','noticeCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('notice.create');
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
        $requestData = $request->all();

        $path = public_path('storage/notices');
        if (Storage::disk('public')->missing('notices')) {
            Storage::disk('public')->makeDirectory('notices');
        }

        if ($request->hasFile('photo')) {
            if(Storage::exists('public/'.$request['photo'])){
                Storage::delete('public/'.$request['photo']);
            }
            $photo = $request->file('photo');
            $photo_name = 'photo-' . time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->save($path . '/' . $photo_name);
            $requestData['photo'] = 'notices/'.$photo_name;
        }

        if ($request->hasFile('file')) {
            if(Storage::exists('public/'.$request['file'])){
                Storage::delete('public/'.$request['file']);
            }
            $file = $request->file('file');
            $file_name = 'file-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $file_name);
            $requestData['file'] = 'notices/'.$file_name;
        }
        $requestData['date'] = Date::now();
        Notice::create($requestData);
        return redirect('notice')->with('success', 'เพิ่มข้อมูลประกาศเรียบร้อยแล้วคะ!');
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
        $notice = Notice::findOrFail($id);

        return view('notice.show', compact('notice'));
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
        $notice = Notice::findOrFail($id);

        return view('notice.edit', compact('notice'));
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
        //notices
        $requestData = $request->all();

        $path = public_path('storage/notices');
        if (Storage::disk('public')->missing('notices')) {
            Storage::disk('public')->makeDirectory('notices');
        }

        if ($request->hasFile('photo')) {
            if(Storage::exists('public/'.$request['photo_old'])){
                Storage::delete('public/'.$request['photo_old']);
            }
            $photo = $request->file('photo');
            $photo_name = $id . 'photo-' . time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->save($path . '/' . $photo_name);
            $requestData['photo'] = 'notices/'.$photo_name;
        }

        if ($request->hasFile('file')) {
            if(Storage::exists('public/'.$request['file_old'])){
                Storage::delete('public/'.$request['file_old']);
            }
            $file = $request->file('file');
            $file_name = $id . 'file-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $file_name);
            $requestData['file'] = 'notices/'.$file_name;
        }

        $notice = Notice::findOrFail($id);
        $notice->update($requestData);

        return redirect('notice')->with('success', 'แก้ไขข้อมูลประกาศเรียบร้อยแล้วคะ!');
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
            $notice = Notice::findOrFail($id);
            if(Storage::exists('public/'.$notice ->photo)){
                Storage::delete('public/'.$notice ->photo);
            }
            if(Storage::exists('public/'.$notice ->file)){
                Storage::delete('public/'.$notice ->file);
            }
            Notice::destroy($id);
            return redirect('notice')->with('success', 'ลบข้อมูลประกาศเรียบร้อยแล้วคะ!');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }

    }
}
