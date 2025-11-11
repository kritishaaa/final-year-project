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

           
        });
    }

    public function down()
    {
        Schema::dropIfExists('parcel_tracks');
    }
}
