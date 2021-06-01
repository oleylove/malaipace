<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
            $arrayStatus = ['สมาชิกใหม่','สมาชิกจอง','สมาชิกเช่า','สมาชิกแจ้งย้าย','สมาชิกออกแล้ว','ผู้ดูแลหอพัก'];
            if (!empty($status)) {
                if (in_array($status,$arrayStatus,TRUE)) {
                    $user = User::where('status', $status)->latest()->paginate($perPage);
                }
            }elseif(!empty($search)){
                $user = User::where('name', 'LIKE', "%$search%")->latest()->paginate($perPage);
            } else {
                $user = User::latest()->paginate($perPage);
            }
            return view('user.index',['navbarSeach' => 'user'], compact('user'));

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
            return view('user.create');
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

            $path = public_path('storage/users');
            if (Storage::disk('public')->missing('users')) {
                Storage::disk('public')->makeDirectory('users');
            }

            if(User::where('email',$requestData['email'])->exists()) {
                if($requestData['password'] != $requestData['password_confirmation']){
                    return redirect()->back()->with('danger', 'รหัสผ่านไม่ตรงกันคะ!');

                }else{
                    return redirect()->back()->with('danger', 'อีเมลล์ ' . $requestData['email']. ' นี้มีคนใช้งานอยู่แล้วคะ!');
                }

            }elseif (User::where('email',$requestData['email'])->doesntExist()) {

                if($requestData['password'] != $requestData['password_confirmation']) {
                    return redirect()->back()->with('danger', 'รหัสผ่านไม่ตรงกันคะ!');

                }elseif ($requestData['password'] == $requestData['password_confirmation']) {
                    $requestData['password'] = Hash::make($request['password']);

                    if ($request->hasFile('photo')) {
                        $requestData['photo'] = $request->file('photo')->store('users', 'public');
                    }

                    User::create($requestData);
                    return redirect('user')->with('success', 'เพิ่มข้อมูลสมาชิกเรียบร้อยแล้วคะ!');
                }
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
        try {
            $user = User::findOrFail($id);
            return view('user.show', compact('user'));
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
            $user = User::findOrFail($id);
            return view('user.edit', compact('user'));
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
            $user = User::findOrFail($id);

            if ($request->hasFile('photo')) {
                $requestData['photo'] = $request->file('photo')->store('users', 'public');
                if(Storage::exists('public/'.$request['photo_old'])){
                    Storage::delete('public/'.$request['photo_old']);
                }
            }

            if($requestData['email'] != $user->email){
                if(User::whereNotIn('id',[$id])->where('email',$requestData['email'])->exists()) {
                    return redirect()->back()->with('danger', 'อีเมลล์ ' . $requestData['email']. ' นี้มีคนใช้งานอยู่แล้วคะ!');
                }
            }else{
                if (Hash::needsRehash($request['password'])) {
                    if($requestData['password'] != $requestData['password_confirmation']){
                        return redirect()->back()->with('danger', 'รหัสผ่านไม่ตรงกันคะ!');

                    }else{
                        $requestData['password'] = Hash::make($request['password']);
                    }
                }else{
                    if($requestData['password'] != $requestData['password_confirmation']){
                        return redirect()->back()->with('danger', 'รหัสผ่านไม่ตรงกันคะ!');

                    }else{
                        $requestData['password'] = $request['password'];
                    }
                }
            }

            $user->update($requestData);

            return redirect('user')->with('success', 'แก้ไขข้อมูลสมาชิกเรียบร้อยแล้วคะ!');
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
        try {
            $user = User::findOrFail($id);
            User::destroy($id);
            if(Storage::exists('public/'.$user->photo)){
                Storage::delete('public/'.$user->photo);
            }
            return redirect('user')->with('success', 'ลบข้อมูลสมาชิกเรียบร้อยแล้วคะ!');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
