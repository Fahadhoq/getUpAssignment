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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Seed 10 customers (You can change the number to your requirement)
        \App\Models\Customer::factory(10)->create();

        // Call the ProductSeeder
        // $this->call(ProductSeeder::class);


        // Call the OrderSeeder to populate the orders table
        // $this->call(OrderSeeder::class);
    }
}
