<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room as RoomEloquent;
use App\Booking as BookingEloquent;
use App\Http\Requests;
use Barryvdh\Debugbar\Facade as Debugbar;

class BookingCalendarController extends Controller
{
    public function index()
    {
        return view('admin/bookingCalendar');
    }

    public function getAllRoom()
    {
        $rooms       = RoomEloquent::All(['id', 'name']);
        $rooms_Array = $rooms->toArray();

        //https://stackoverflow.com/questions/9605143/how-to-rename-array-keys-in-php/29434152
        //將room['name'] 改成 room['title'] 配合fullcalendar Resource需求
        $rooms_Array = array_map(function ($rooms_Array) {
            return array(
                'id'  => $rooms_Array['id'],
                'title' => $rooms_Array['name'],
            );
        }, $rooms_Array);

        return json_encode($rooms_Array);
    }

    public function getAllBooking(){
    	$bookings       = BookingEloquent::with('user')->get();
    	return $bookings->toJson();
    }
}
