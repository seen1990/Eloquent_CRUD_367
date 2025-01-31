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
            'customer_id'=> $this->faker->unique()->numerify(str_repeat('#', 5)),
            'first_name' => $this->faker->firstName(), 
            'last_name' => $this->faker->lastName(),   
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']), 
            'email' => $this->faker->unique()->safeEmail(), 
            'phone' => $this->faker->phoneNumber(), 
            'address' => $this->faker->address(),
        ];
    }
}
