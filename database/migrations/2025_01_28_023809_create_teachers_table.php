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
    public function up()
    {
    Schema::create('teachers', function (Blueprint $table) {
        $table->bigIncrements('teacher_id')->primary();
        $table->string('first_name', 20); // ชื่อ
        $table->string('last_name', 20); // นามสกุล
        $table->string('phone', 10); 
        $table->string('email')->unique(); // อีเมล์
        $table->string('department', 100);
    });
    // ตั้งค่า AUTO_INCREMENT 
    DB::statement('ALTER TABLE teachers AUTO_INCREMENT = 106001');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
