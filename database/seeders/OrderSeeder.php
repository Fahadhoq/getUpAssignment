<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Fetch all customers and products
        $customers = Customer::all();
        $products = Product::all();

        // Create 50 orders (You can change the number as needed)
        for ($i = 0; $i < 50; $i++) {
            // Pick a random customer and product for each order
            $customer = $customers->random();
            $product = $products->random();

            // Create a new order
            Order::create([
                'customer_id' => $customer->id,
                'product_id' => $product->id,
                'quantity' => rand(1, 10),  // Random quantity between 1 and 10
                'total_price' => $product->price * rand(1, 10), // Calculate total price
            ]);
        }
    }
}

