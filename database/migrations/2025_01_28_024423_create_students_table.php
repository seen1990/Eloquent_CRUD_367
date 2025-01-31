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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id'); // Primary Key
            $table->string('first_name'); // ชื่อ
            $table->string('last_name'); // นามสกุล
            $table->string('gender'); // เพศ
            $table->string('email')->unique(); // อีเมล์
            $table->date('birth_date'); // วันเกิด
            $table->unsignedBigInteger('faculty_id');
            $table->foreign('faculty_id')->references('faculty_id')->on('faculties')->onDelete('cascade'); // คณะ (Foreign Key)
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade'); // อาจารย์ (Foreign Key)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
