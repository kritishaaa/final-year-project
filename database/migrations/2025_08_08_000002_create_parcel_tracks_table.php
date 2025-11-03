<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateParcelTracksTable extends Migration
{
    public function up()
    {
        Schema::create('parcel_tracks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parcel_id');
            $table->tinyInteger('status');
            $table->dateTime('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));

            // If you want a foreign key constraint uncomment the following line
            // $table->foreign('parcel_id')->references('id')->on('parcels')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('parcel_tracks');
    }
}
