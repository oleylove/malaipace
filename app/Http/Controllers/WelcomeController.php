<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webconfig;
use App\Type;
use App\Room;
Use PDF;

class WelcomeController extends Controller
{
    public function index()
    {
        try {

            $wcfg = Webconfig::first();
            return view('welcome', compact('wcfg'));

        } catch (Exception $ex) {

            return $ex->getMessage();

        }
    }

    public function typeGrid()
    {
        try {

            $types = Type::orderBy('price', 'ASC')->get();
            return view('type-grid' , compact('types') );

        } catch (Exception $ex) {

            return $ex->getMessage();

        }
    }

    public function typeAll()
    {
        try {

            $types = Type::orderBy('price', 'ASC')->get();
            return view('type-all' , compact('types') );

        } catch (Exception $ex) {

            return $ex->getMessage();

        }
    }

    public function roomGrid($id)
    {
        try {

            $perPage = 12;
            $rooms = Room::where('typ_id',$id)
                ->where('status','ว่าง')
                ->orderBy('building', 'ASC')
                ->paginate($perPage);
            $type = Type::findOrFail($id);
            return view('room-grid', compact('rooms','type'));

        } catch (Exception $ex) {

            return $ex->getMessage();

        }
    }

    public function roomSigle($id)
    {
        try {
            $wcfg = Webconfig::latest()->first();
            $room = Room::findOrFail($id);
            return view('room-single', compact('room','wcfg'));

        } catch (Exception $ex) {

            return $ex->getMessage();

        }
    }
}
