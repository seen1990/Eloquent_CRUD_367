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
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('course_id')->primary();
            $table->string('course_name'); // ชื่อรายวิชา
            $table->text('course_description'); // รายละเอียดรายวิชา
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade'); // อาจารย์ (Foreign Key)
        });
        // ตั้งค่า AUTO_INCREMENT 
        DB::statement('ALTER TABLE courses AUTO_INCREMENT = 14011');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
