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
            $table->id();
            $table->unsignedBigInteger('parcel_id');
            $table->string('status')->nullable();
            $table->string('message')->nullable();
            $table->string('location')->nullable();
             $table->timestamps();


           
        });
    }

    public function down()
    {
        Schema::dropIfExists('parcel_tracks');
    }
}
