<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Create 20 products (You can change the number to your requirement)
        Product::factory(100)->create();
    }
}

