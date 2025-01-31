<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('teachers', function (Blueprint $table) {
        $table->id('teacher_id'); // Primary Key
        $table->string('first_name'); // ชื่อ
        $table->string('last_name'); // นามสกุล
        $table->string('gender'); // เพศ
        $table->string('email')->unique(); // อีเมล์
        $table->unsignedBigInteger('faculty_id');
        $table->foreign('faculty_id')->references('faculty_id')->on('faculties')->onDelete('cascade'); // คณะ (Foreign Key)
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
