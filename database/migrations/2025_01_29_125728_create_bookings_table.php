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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
    
            $table->unsignedBigInteger('customer_id'); // อ้างอิงลูกค้า
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');

            $table->unsignedBigInteger('room_id'); // อ้างอิงห้องพัก
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');

            $table->dateTime('booked_at');
            $table->dateTime('check_in'); // วันเช็คอิน
            $table->dateTime('check_out'); // วันเช็คเอาท์
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending'); // สถานะการจอง
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
