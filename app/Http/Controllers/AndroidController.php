<?php

namespace App\Http\Controllers;

use App\User as UserEloquent;
use App\Room as RoomEloquent;
use App\Booking as BookingEloquent;

use Illuminate\Http\Request;
use Redirect;


class AndroidController extends Controller
{
    //Android
    public function AndroidLogin(Request $request)
    {
        $login_user = UserEloquent::where('email', $request->input('email'))->where('password', $request->input('password'))->first();
        if (isset($login_user)) {
            return $login_user;
        }
    }

    public function AndroidRegister(Request $request)
    {
        $new_user           = new UserEloquent;
        $new_user->name     = $request->input('name');
        $new_user->email    = $request->input('email');
        $new_user->password = $request->input('password');
        $new_user->save();
        return response()->json([
            "message" => "Success",
        ]);
    }

    public function AndroidGetGetRoomList()
    {
        $rooms = RoomEloquent::all();
        return $rooms;
    }

    public function AndroidGetBooking($roomID)
    {
        // $bookings = BookingEloquent::all()->where('room_id', (int) $roomID);
        $bookings = BookingEloquent::where('room_id','=', (int) $roomID)->where('status','!=',"Cancel")->get();
        return $bookings;
    }

    public function AndroidBookRoom(Request $request)
    {
        $booking          = new BookingEloquent;
        $booking->user_id = $request->input('user_id');
        $booking->room_id = $request->input('room_id');
        $booking->start   = $request->input('start');
        $booking->end     = $request->input('end');
        $booking->save();
        return response()->json([
            "message" => "Success",
        ]);
        // return date(c,$request->input('start'));
    }


}
