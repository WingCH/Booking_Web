<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Room as RoomEloquent;
use App\Booking as BookingEloquent;
use App\User as UserEloquent;


class Booking extends Model
{
    public function room(){
    	return $this->belongsTo(RoomEloquent::class);
    	//booking.room_id <=> room.id
    }

    public function user(){
    	return $this->belongsTo(UserEloquent::class);
    	//booking.user_id <=> user.id
    }
}
