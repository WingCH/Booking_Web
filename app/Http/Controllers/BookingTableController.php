<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking as BookingEloquent;

use App\Http\Requests;

class BookingTableController extends Controller
{
    public function index()
    {
        return view('admin/bookingTable');
    }

    public function getAllBookingList()
    {
        //user 對應 Booking.php user()
        $bookings = BookingEloquent::with('user', 'room')->get();
        return $bookings->toJson();
    }
}
