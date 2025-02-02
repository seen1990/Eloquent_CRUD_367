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
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('customer_id')->primary();
            $table->string('first_name', 20); // ชื่อ
            $table->string('last_name', 20); // นามสกุล
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('email')->unique();
            $table->string('phone', 10); 
            $table->string('address');

        });
        // ตั้งค่า AUTO_INCREMENT เริ่มต้นที่ 10001
        DB::statement('ALTER TABLE customers AUTO_INCREMENT = 10001');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
