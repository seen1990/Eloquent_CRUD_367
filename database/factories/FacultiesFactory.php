<?php

namespace Database\Factories;

use App\Models\Faculties;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faculties>
 */
class FacultiesFactory extends Factory
{
    protected $model = Faculties::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faculties = [
            'Architecture',
            'Economics',
            'Engineering',
            'Science',
            'Medicine',
            'Nursing',
            'Pharmacy',
            'Law',
        ];

        return [
            'faculty_name' => $this->faker->unique()->randomElement($faculties),
        ];
    }
}
