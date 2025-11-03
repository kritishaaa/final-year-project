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
        Schema::create('parcel_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parcel_id');
            $table->enum('payment_method', ['cash', 'card', 'online'])->default('cash');
            $table->float('amount');
            $table->boolean('paid')->default(false);
            
            // Foreign key
            $table->foreign('parcel_id')->references('id')->on('parcels')->onDelete('cascade');
       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcel_payments');
    }
};
