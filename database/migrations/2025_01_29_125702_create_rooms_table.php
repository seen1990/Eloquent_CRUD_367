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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id');
            $table->string('room_number')->unique(); // หมายเลขห้อง
            $table->enum('status', ['available', 'booked', 'maintenance'])->default('available'); // สถานะห้อง
            $table->unsignedBigInteger('type_id'); // ประเภทห้อง
            $table->foreign('type_id')->references('type_id')->on('room_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
