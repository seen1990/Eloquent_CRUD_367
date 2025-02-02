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
        static $roomNumber = 101;

        return [
            'room_number' => str_pad($roomNumber++, 3, '0', STR_PAD_LEFT), // เลขห้อง 3 หลัก
            'status' => $this->faker->randomElement(['available', 'booked', 'maintenance']),
            'type_id' => \App\Models\RoomType::inRandomOrder()->first()->type_id, // ใช้ประเภทห้องแบบสุ่ม
        ];
    }
}
