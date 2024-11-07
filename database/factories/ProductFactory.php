<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),  // Random product name
            'description' => $this->faker->sentence(),  // Random product description
            'price' => $this->faker->randomFloat(2, 5, 100),  // Random price between 5 and 100
            'stock' => $this->faker->numberBetween(1, 1000),  // Random stock quantity
        ];
    }
}

