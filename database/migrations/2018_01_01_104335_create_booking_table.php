<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');//booking id
            $table->Integer('user_id');//book個個人既id
            $table->Integer('room_id');//間活動室既id
            // $table->timestamp('start');//開始時間
            // $table->timestamp('end');//結束時間

            //https://laracasts.com/discuss/channels/eloquent/why-table-timestamps-puts-on-update-current-timestamp-on-the-created-at-column
            $table->timestamp('start')->nullable();//開始時間
            $table->timestamp('end')->nullable();//結束時間 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bookings');
    }
}
