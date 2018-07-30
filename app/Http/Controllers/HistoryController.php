<?php

namespace App\Http\Controllers;

use App\Booking as BookingEloquent;
use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;

class HistoryController extends Controller
{
    public function getBookingList($user_ID)
    {
        //user 對應 Booking.php user()
        $bookings = BookingEloquent::with('user', 'room')->where('user_id', $user_ID)->orderBy('start', 'desc')->get();
        // Debugbar::info($bookings->toArray());
        // return $bookings->toJson();
        return $bookings;
    }

    public function index()
    {
        return view('history');
    }

    public function changeStatus(Request $request)
    {
        $booking = BookingEloquent::find($request->input('booking_id'));
        $booking->status = $request->input('status');
        $booking->save();

        return $booking->status ;
    }
}
