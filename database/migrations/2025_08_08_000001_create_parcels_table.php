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
            
            $table->string('tracking_code', 50)->unique();
            $table->string('sender_name');
            $table->string('sender_address');
            $table->string('sender_contact');
            $table->foreignId('from_branch_id')->constrained('branches')->onDelete('cascade');
            $table->foreignId('to_branch_id')->constrained('branches')->onDelete('cascade');
            $table->decimal('weight', 8, 2);
            $table->decimal('distance', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('status', ['pending', 'in_transit', 'delivered', 'cancelled'])->default('pending');
            $table->string('recipient_name');
            $table->string('recipient_contact');
            $table->text('recipient_address');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parcels');
    }
}
