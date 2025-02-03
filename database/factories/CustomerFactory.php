<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customers>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(), 
            'last_name' => $this->faker->lastName(),   
            'email' => $this->faker->unique()->safeEmail(), 
            'phone' => $this->faker->numerify('##########'),
            'address' => $this->faker->address(),
        ];
    }
}
