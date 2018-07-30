<?php

namespace App\Http\Controllers;

use App\Booking as BookingEloquent;
use App\Room as RoomEloquent;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\Redirect;

class RoomController extends Controller
{
    public function index($roomID)
    {
        $room = RoomEloquent::find($roomID);
        Debugbar::info($room->toArray());

        return view('room', ['room' => $room]);
    }

    public function getBooking($roomID)
    {
        $bookings = BookingEloquent::where('room_id','=', (int) $roomID)->where('status','!=',"Cancel")->get();
        Debugbar::info($bookings->toArray());
        return $bookings;
    }

    public function bookRoom(Request $request)
    {
        $booking          = new BookingEloquent;
        $booking->user_id = $request->input('user_id');
        $booking->room_id = $request->input('room_id');
        $booking->start   = json_decode($request->input('start')); //decode
        $booking->end     = json_decode($request->input('end'));
        $booking->save();
        // return date(c,$request->input('start'));
    }

    public function updateBookingTime(Request $request)
    {
      $booking  = BookingEloquent::where('id','=',$request->input('booking_id'))->where('user_id', $request->input('user_id'))->firstOrFail();
      $booking->start   = json_decode($request->input('start')); //decode
      $booking->end     = json_decode($request->input('end'));
      $booking->save();
    }

    public function addRoomIndex()
    {
        return view('add_Room');
    }

    public function addRoom(Request $request)
    {
        //getClientOriginalName() originalName eg: Screenshot_2016-03-27-18-37-07.jpg
        //getClientOriginalExtension() Type eg: Screenshot_2016-03-27-18-37-07.jpg

        $name = $request->input('name');
        $type = $request->file('background')->getClientOriginalExtension();
        $fileName = $name.".".$type;
        //將相片save去public方便拎 沒有用fileSystem
        $request->file('background')->move(public_path("photo/rooms"), $fileName);

        $room = new RoomEloquent;
        $room -> name = $name;
        $room -> description = $request->input('description');
        $room -> address = $request->input('address');
        $room -> backgroundImage = '/photo/rooms/'.$fileName;
        $room->save();

        return redirect()->action('HomeController@index');
    }

}
