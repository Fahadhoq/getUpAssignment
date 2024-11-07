<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,          // Random full name
            'email' => $this->faker->unique()->safeEmail,  // Unique random email address
        ];
    }
}

