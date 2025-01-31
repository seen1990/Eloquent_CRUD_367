<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RoomType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomType>
 */
class RoomTypeFactory extends Factory
{
    protected $model = RoomType::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_name' => $this->faker->unique()->word(), // ชื่อประเภทห้อง
            'description' => $this->faker->sentence(), // คำอธิบาย
            'price_per_night' => $this->faker->randomFloat(2, 500, 5000), // ราคาต่อคืนแบบสุ่ม (500-5000)
        ];
    }
}
