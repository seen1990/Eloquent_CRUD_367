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
        Schema::create('product_lists', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name');
            $table->text('description');
            $table->string('stock');
            $table->decimal('price', 5, 2);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('product_categories')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productlists');
    }
};
