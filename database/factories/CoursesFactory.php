<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Courses;
use App\Models\Teachers;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courses>
 */
class CoursesFactory extends Factory
{
    protected $model = Courses::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_name' => $this->faker->words(3, true), // ชื่อรายวิชาแบบสุ่ม
            'course_description' => $this->faker->paragraph(), // รายละเอียดรายวิชาแบบสุ่ม
            'teacher_id' => \App\Models\Teachers::inRandomOrder()->first()->teacher_id, // เลือก teacher_id จาก teachers ที่มีอยู่
        ];
    }
}
