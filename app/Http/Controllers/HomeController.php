<?php

namespace App\Http\Controllers;

use App\Room as RoomEloquent;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::guest()) {
            $rooms = RoomEloquent::all();
            return view('home', ['rooms' => $rooms]);
        } else {
            if (Auth::user()->role === "admin") {
                return redirect()->action('BookingCalendarController@index');
            } else {
                $rooms = RoomEloquent::all();
                return view('home', ['rooms' => $rooms]);
            }
        }

    }

}
