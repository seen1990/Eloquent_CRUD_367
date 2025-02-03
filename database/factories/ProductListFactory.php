<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductList;
use App\Models\ProductCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Productlists>
 */
class ProductListFactory extends Factory
{
    protected $model = ProductList::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => $this->faker->word(), // ชื่อสินค้า
            'price' => $this->faker->randomFloat(2, 1, 999),//ราคาสินค้า
            'stock' => $this->faker->numberBetween(1, 100), // จำนวนสินค้าในสต็อก
            'category' => $this->faker->word,
            
            
            
        ];
    }
}
