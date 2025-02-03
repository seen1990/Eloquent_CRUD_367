<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->customer_id, // ใช้ customer_id แบบสุ่ม
            'room_id' => Room::inRandomOrder()->first()->room_id, // ใช้ room_id แบบสุ่ม
            'booked_at'=> $this->faker->dateTimeThisMonth(),
            'check_in' => $this->faker->dateTimeThisMonth(), // วันที่เช็คอิน
            'check_out' => $this->faker->dateTimeBetween('now', '+1 week'), // วันที่เช็คเอาท์
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']), // สถานะการจอง
        ];
    }
}
