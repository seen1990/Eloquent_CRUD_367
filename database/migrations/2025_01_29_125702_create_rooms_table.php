<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('room_id')->primary();
            $table->string('room_number', 3)->unique(); // หมายเลขห้อง
            $table->enum('status', ['available', 'booked', 'maintenance'])->default('available'); // สถานะห้อง
            $table->unsignedBigInteger('type_id'); // ประเภทห้อง
            $table->foreign('type_id')->references('type_id')->on('room_types')->onDelete('cascade');
        });
        // ตั้งค่า AUTO_INCREMENT เริ่มต้นที่ 1001
        DB::statement('ALTER TABLE rooms AUTO_INCREMENT = 1001');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
