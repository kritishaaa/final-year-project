<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->string('email', 200);
            $table->string('contact', 20);
            $table->text('address');
            $table->text('cover_img');
        });
    }

    public function down()
    {
        Schema::dropIfExists('system_settings');
    }
}
