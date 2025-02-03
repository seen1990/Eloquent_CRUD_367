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
        Schema::create('product_lists', function (Blueprint $table) {
            $table->bigIncrements('product_id')->primary();
            $table->string('product_name', 30 );
            $table->decimal('price', 5, 2);
            $table->string('stock');
            $table->string('category');
            
        });
        // ตั้งค่า AUTO_INCREMENT เริ่มต้นที่ 10001
        DB::statement('ALTER TABLE product_lists AUTO_INCREMENT = 10001');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productlists');
    }
};
