<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Webconfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\MessageBag;
class WebconfigController extends Controller
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
            $webconfig = Webconfig::first();
            return view('webconfig.index', compact('webconfig'));
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
        // try {
        //     return view('webconfig.create');
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
        // try {

        //     $requestData = $request->all();
        //     if ($request->hasFile('bbl_logo')) {
        //         $requestData['bbl_logo'] = $request->file('bbl_logo')
        //             ->store('uploads', 'public');
        //     }
        //     if ($request->hasFile('kbsnk_logo')) {
        //         $requestData['kbsnk_logo'] = $request->file('kbsnk_logo')
        //             ->store('uploads', 'public');
        //     }
        //     if ($request->hasFile('scb_logo')) {
        //         $requestData['scb_logo'] = $request->file('scb_logo')
        //             ->store('uploads', 'public');
        //     }
        //     if ($request->hasFile('logo')) {
        //         $requestData['logo'] = $request->file('logo')
        //             ->store('uploads', 'public');
        //     }
        //     if ($request->hasFile('photo1')) {
        //         $requestData['photo1'] = $request->file('photo1')
        //             ->store('uploads', 'public');
        //     }
        //     if ($request->hasFile('photo2')) {
        //         $requestData['photo2'] = $request->file('photo2')
        //             ->store('uploads', 'public');
        //     }
        //     if ($request->hasFile('photo3')) {
        //         $requestData['photo3'] = $request->file('photo3')
        //             ->store('uploads', 'public');
        //     }
        //     if ($request->hasFile('photo4')) {
        //         $requestData['photo4'] = $request->file('photo4')
        //             ->store('uploads', 'public');
        //     }
        //     if ($request->hasFile('photo5')) {
        //         $requestData['photo5'] = $request->file('photo5')
        //             ->store('uploads', 'public');
        //     }

        //     Webconfig::create($requestData);

        //     return redirect('webconfig')->with('flash_message', 'Webconfig added!');
        // } catch (Exception $ex) {
        //     return $ex->getMessage();
        // }
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
        //     $webconfig = Webconfig::findOrFail($id);
        //     return view('webconfig.show', compact('webconfig'));
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
        //     $webconfig = Webconfig::findOrFail($id);
        //     return view('webconfig.edit', compact('webconfig'));
        // } catch (Exception $ex) {
        //     return $e->getMessage();
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
            $id = $requestData['id'];

            $path = public_path('storage/webconfigs');
            if (Storage::disk('public')->missing('webconfigs')) {
                Storage::disk('public')->makeDirectory('webconfigs');
            }

            $webconfig = Webconfig::findOrFail($id);
            if ($requestData['mode'] == 'slide') {
                if ($request->hasFile('photo_slide')) {
                    switch ($requestData['photo_slide_select']) {
                        case 1:
                            $photo = 'photo1';
                            $photo_old = $webconfig->photo1;
                            $requestData['photo1'] = $requestData['photo_slide'];
                            $message = 'แก้ไขรูป Slide-1 เรียบร้อยแล้วคะ';
                        break;
                        case 2:
                            $photo = 'photo2';
                            $photo_old = $webconfig->photo2;
                            $requestData['photo2'] = $requestData['photo_slide'];
                            $message = 'แก้ไขรูป Slide-2 เรียบร้อยแล้วคะ';
                        break;
                        case 3:
                            $photo = 'photo3';
                            $photo_old = $webconfig->photo3;
                            $requestData['photo3'] = $requestData['photo_slide'];
                            $message = 'แก้ไขรูป Slide-3 เรียบร้อยแล้วคะ';
                        break;
                        case 4:
                            $photo = 'photo4';
                            $photo_old = $webconfig->photo4;
                            $requestData['photo4'] = $requestData['photo_slide'];
                            $message = 'แก้ไขรูป Slide-4 เรียบร้อยแล้วคะ';
                        break;
                        case 5:
                            $photo = 'photo5';
                            $photo_old = $webconfig->photo5;
                            $requestData['photo5'] = $requestData['photo_slide'];
                            $message = 'แก้ไขรูป Slide-5 เรียบร้อยแล้วคะ';
                        break;
                    }

                    if(Storage::exists('public/'.$photo_old)){
                        Storage::delete('public/'.$photo_old);
                    }
                    $photo_new = $request->file('photo_slide');
                    $photo_name = $photo.'-'.time().'.'.$photo_new->getClientOriginalExtension();
                    Image::make($photo_new)->resize(1920, 960)->save($path.'/'.$photo_name);
                    $requestData[$photo] = 'webconfigs/'.$photo_name;
                }
            }

            if ($requestData['mode'] == 'bank') {
                switch ($requestData['bank_select']) {
                    case 1:
                        $photo = 'bbl_logo';
                        $photo_old = $webconfig->bbl_logo;
                        if($request->hasFile('photo_logo')){
                            $requestData['bbl_logo'] = $requestData['photo_logo'];
                        }
                        if($requestData['bankname']){
                            $requestData['bbl'] = $requestData['bankname'];
                        }
                        $logo_old = $webconfig->bbl;
                        $message = 'แก้ไขข้อมูลบัญชีธนาคารกรุงเทพเรียบร้อยแล้วคะ';
                    break;
                    case 2:
                        $photo = 'kbsnk_logo';
                        $photo_old = $webconfig->kbsnk_logo;
                        if($request->hasFile('photo_logo')){
                            $requestData['kbsnk_logo'] = $requestData['photo_logo'];
                        }
                        if($requestData['bankname']){
                            $requestData['kbsnk'] = $requestData['bankname'];
                        }
                        $logo_old = $webconfig->kbsnk;
                        $message = 'แก้ไขข้อมูลบัญชีธนาคารกสิกรไทยเรียบร้อยแล้วคะ';
                    break;
                    case 3:
                        $photo = 'scb_logo';
                        $photo_old = $webconfig->scb_logo;
                        if($request->hasFile('photo_logo')){
                            $requestData['scb_logo'] = $requestData['photo_logo'];
                        }
                        if($requestData['bankname']){
                            $requestData['scb'] = $requestData['bankname'];
                        }
                        $logo_old = $webconfig->scb;
                        $message = 'แก้ไขข้อมูลบัญชีธนาคารไทยพาณิชย์เรียบร้อยแล้วคะ';
                    break;
                    case 4:
                        $photo = 'bay_logo';
                        $photo_old = $webconfig->bay_logo;

                        if($request->hasFile('photo_logo')){
                            $requestData['bay_logo'] = $requestData['photo_logo'];
                        }
                        if($requestData['bankname']){
                            $requestData['bay'] = $requestData['bankname'];
                        }
                        $logo_old = $webconfig->bay;
                        $message = 'แก้ไขข้อมูลบัญชีธนาคารกรุงศรีอยุธยาเรียบร้อยแล้วคะ';
                    break;
                }
                if ($request->hasFile('photo_logo')) {
                    if(Storage::exists('public/'.$webconfig->$bank_logo_old)){
                        Storage::delete('public/'.$bank_logo_old);
                    }
                    $photo_new = $request->file('photo_logo');
                    $photo_name = $photo.'-'.time().'.'.$photo_new->getClientOriginalExtension();
                    Image::make($photo_new)->save($path.'/'.$photo_name);
                    $requestData[$photo] = 'webconfigs/'.$photo_name;
                }

            }

            if ($requestData['mode'] == 'config') {
                if ($request->hasFile('logo')) {
                    if(Storage::exists('public/'.$webconfig->$logo_old)){
                        Storage::delete('public/'.$logo_old);
                    }
                    $logo_new = $request->file('logo');
                    $logo_name = 'logo-'.time().'.'.$logo_new->getClientOriginalExtension();
                    Image::make($logo_new)->save($path.'/'.$logo_name);
                    $requestData['logo'] = 'webconfigs/'.$logo_name;
                }
                $requestData['title'] = $request['title'];
                $requestData['website'] = $request['website'];
                $requestData['address'] = $request['address'];
                $message = 'แก้ไขข้อมูลของอพาร์ทเม้นท์เรียบร้อยแล้วคะ';
            }

            $webconfig->update($requestData);
            return redirect()->back()->with('success',$message);

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
        //     Webconfig::destroy($id);
        //     return redirect('webconfig')->with('flash_message', 'Webconfig deleted!');
        // } catch (Exception $ex) {
        //     return $e->getMessage();
        // }
    }
}
