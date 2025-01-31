<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Students;
use App\Models\Faculties;
use App\Models\Teachers;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Students>
 */
class StudentsFactory extends Factory
{
    protected $model = Students::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id'=> $this->faker->numerify(str_repeat('#', 10)),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'email' => $this->faker->unique()->safeEmail(),
            'birth_date' => $this->faker->date('Y-m-d', '-18 years'), // อายุอย่างน้อย 18 ปี
            'faculty_id' => \App\Models\Faculties::inRandomOrder()->first()->faculty_id,
            'teacher_id' => \App\Models\Teachers::inRandomOrder()->first()->teacher_id,
        ];
    }
}
