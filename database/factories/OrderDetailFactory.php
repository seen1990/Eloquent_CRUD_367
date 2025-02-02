<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\ProductList;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order_details>
 */
class OrderDetailFactory extends Factory
{
    protected $model = OrderDetail::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first()->order_id ?? 1, // อ้างอิงคำสั่งซื้อแบบสุ่ม
            'product_id' => ProductList::inRandomOrder()->first()->product_id ?? 1, // อ้างอิงสินค้าจากตาราง productlists
            'quantity' => $this->faker->numberBetween(1, 100), // จำนวนสินค้าที่สั่ง
           
        ];
    }
}
