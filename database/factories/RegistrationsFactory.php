<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Registrations;
use App\Models\Students;
use App\Models\Courses;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registrations>
 */
class RegistrationsFactory extends Factory
{
    protected $model = Registrations::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => \App\Models\Students::inRandomOrder()->first()->student_id, // เลือก student_id แบบสุ่มจากฐานข้อมูล
            'course_id' => \App\Models\Courses::inRandomOrder()->first()->course_id,   // เลือก course_id แบบสุ่มจากฐานข้อมูล
            'register_date'=> $this->faker->dateTimeBetween('-2 week', '+2 week'),
        ];
    }
}
