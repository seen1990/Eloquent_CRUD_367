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
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('student_id')->primary();
            $table->string('first_name', 20); // ชื่อ
            $table->string('last_name', 20); // นามสกุล
            $table->string('phone', 10); 
            $table->string('email')->unique(); // อีเมล์
            $table->string('major', 100);
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade'); // อาจารย์ (Foreign Key)
        });
        // ตั้งค่า AUTO_INCREMENT 
        DB::statement('ALTER TABLE students AUTO_INCREMENT = 103001');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
