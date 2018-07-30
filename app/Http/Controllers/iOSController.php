<?php

namespace App\Http\Controllers;

use App\Booking as BookingEloquent;
use App\Room as RoomEloquent;
use App\User as UserEloquent;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Http\Request;

class iOSController extends Controller
{
    //Login
    public function iOSLogin(Request $request)
    {
        $login_user = UserEloquent::where('email', $request->input('email'))->where('password', $request->input('password'))->first();

        if (isset($login_user)) {
            return $login_user;
        }
    }

    //Register
    public function iOSRegister(Request $request)
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

    //Get All Room
    public function iOSGetRoomList()
    {
        $rooms = RoomEloquent::all();
        return $rooms;
    }

    //Get Booking by roomID
    public function iOSGetBookingListByRoomID($roomID)
    {
        $bookings = BookingEloquent::with('user', 'room')->where('room_id', '=', (int) $roomID)->where('status', '!=', "Cancel")->get();
        Debugbar::info($bookings->toArray());
        return $bookings;
    }

    public function iOSGetBookingListByUserID($userID)
    {
        //user 對應 Booking.php user()
        $bookings = BookingEloquent::with('user', 'room')->where('user_id', $userID)->orderBy('start', 'desc')->get();
        return $bookings;
    }

    public function iOSGetBookingByBookingID($bookingID)
    {
        //user 對應 Booking.php user()
        $booking = BookingEloquent::with('user', 'room')->find($bookingID);
        if (isset($booking)) {
          return $booking;
        }
    }

    public function iOSBookRoom(Request $request)
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

    public function iOSUpdateStatus(Request $request)
    {
        $booking = BookingEloquent::find($request->input('booking_id'));
        $booking->status = $request->input('status');
        $booking->save();

        return $booking->status ;
    }

    public function iOSDeleteRoom(Request $request)
    {
      $room = RoomEloquent::find($request->input('room_id'));
      $room -> delete();

      return response()->json([
          "message" => "Success",
      ]);
        // return $rooms->toJson();
    }

    public function iOSAddRoom(Request $request)
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

        return response()->json([
            "message" => "Success",
        ]);
    }
}
