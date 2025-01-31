<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id'=> $this->faker->unique()->numerify(str_repeat('#', 4)),
            'room_number' => $this->faker->unique()->numberBetween(100, 999), // เลขห้อง 3 หลัก
            'status' => $this->faker->randomElement(['available', 'booked', 'maintenance']),
            'type_id' => \App\Models\RoomType::inRandomOrder()->first()->type_id, // ใช้ประเภทห้องแบบสุ่ม
        ];
    }
}
