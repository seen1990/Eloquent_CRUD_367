<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->customer_id ?? 1, // อ้างอิงลูกค้าแบบสุ่ม
            'ordered_at' => $this->faker->dateTimeThisYear(), // วันที่สั่งซื้อ
            'status' => $this->faker->randomElement(['Pending', 'Completed', 'Cancelled']), // สถานะการสั่งซื้อ
        ];
    }
}
