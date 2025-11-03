<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateParcelsTable extends Migration
{
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference_number', 100);
            $table->text('sender_name');
            $table->text('sender_address');
            $table->text('sender_contact');
            $table->text('recipient_name');
            $table->text('recipient_address');
            $table->text('recipient_contact');
            $table->tinyInteger('type'); // 1 = Deliver, 2 = Pickup
            $table->string('from_branch_id', 30);
            $table->string('to_branch_id', 30);
            $table->string('weight', 100);
            $table->string('height', 100);
            $table->string('width', 100);
            $table->string('length', 100);
            $table->float('price');
            $table->tinyInteger('status')->default(0);
            $table->dateTime('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('parcels');
    }
}
