<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parcel_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parcel_id');
            $table->unsignedBigInteger('courier_id');
            $table->tinyInteger('status')->default(0); // 0=Pending, 1=Assigned, 2=Picked, 3=Delivered
            $table->dateTime('assigned_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            

            // Foreign keys
            $table->foreign('parcel_id')->references('id')->on('parcels')->onDelete('cascade');
            $table->foreign('courier_id')->references('id')->on('couriers')->onDelete('cascade');
       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcel_assignments');
    }
};
