<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room as RoomEloquent;


use App\Http\Requests;

class RoomTableController extends Controller
{
    public function index()
    {
        return view('admin/roomTable');
    }

    public function getRoomList()
    {
    	$rooms = RoomEloquent::All();
        return $rooms->toJson();
    }

    public function deleteRoom(Request $request)
    {
    	$room = RoomEloquent::find($request->input('room_id'));
    	$room -> delete();
        // return $rooms->toJson();
    }

}
