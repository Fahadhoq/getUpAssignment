<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        \App\Models\User::factory(1)->create();

        // Call the CategorySeeder
        $this->call(CategorySeeder::class);

        // Seed 10 customers (You can change the number to your requirement)
        $this->call(CustomerSeeder::class);

        // Call the productSeeder to populate the product table
        $this->call(ProductSeeder::class);

        // Call the OrderSeeder to populate the orders table
        $this->call(OrderSeeder::class);
   
    }
}
