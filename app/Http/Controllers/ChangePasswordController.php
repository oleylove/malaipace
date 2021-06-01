<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
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
     * changepassword the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changepassword(Request $request)
    {
        try {

            $request->validate([
                'current_password' => ['required', new MatchOldPassword],
                'new_password' => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ]);

            $user = User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

            return redirect()->back()->with('success','เปลี่ยนรหัสผ่านเรียบร้อบแล้วคะ!');


        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
