<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        // Create 10 Customer (You can change the number to your requirement)
        \App\Models\Customer::factory(10)->create();
    }
}

