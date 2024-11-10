<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, // Generates a random word for the category name
            'description' => $this->faker->sentence, // Generates a random sentence for the category description
        ];
    }
}
