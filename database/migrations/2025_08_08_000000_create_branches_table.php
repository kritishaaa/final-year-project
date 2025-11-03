<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBranchesTable extends Migration
{
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branch_code', 50);
            $table->text('street');
            $table->text('city');
            $table->text('state');
            $table->string('zip_code', 50);
            $table->text('country');
            $table->string('contact', 100);
            $table->dateTime('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
