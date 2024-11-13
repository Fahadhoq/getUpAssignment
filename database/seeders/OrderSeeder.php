<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Faker\Factory as Faker;
use Carbon\Carbon;
class OrderSeeder extends Seeder
{
    public function run()
    {
        // Fetch all customers and products
        $customers = Customer::all();
        $products = Product::all();

        // Create 50 orders (You can change the number as needed)
        for ($i = 0; $i < 50; $i++) {
            // Pick a random customer for each order
            $customer = $customers->random();

            $parent_order = new Order;
            $parent_order->customer_id = $customer->id;
            // Generate a random date between 1 year ago and 1 year ahead
            $randomDate = Carbon::now()->subMonths(rand(0, 3))->addDays(rand(0, 30));
            // Assign the random date to the order_date field
            $parent_order->order_date = $randomDate;
            $parent_order->save();

            $parent_order_qty = 0;
            $parent_order_amount = 0;
            $num_child_orders = rand(1, 10);  // Random number of child orders per parent order

            for ($x = 0; $x < $num_child_orders; $x++) {
                $product = $products->random();
                $quantity = rand(1, 10);  // Random quantity for each child order

                $child_order = new Order;
                $child_order->parent_order_id = $parent_order->id;  // Associate with parent order
                $child_order->product_id = $product->id;
                $child_order->quantity = $quantity;
                $child_order->total_price = $product->price * $quantity;
                $child_order->save();

                // Accumulate quantities and prices for the parent order
                $parent_order_qty += $child_order->quantity;
                $parent_order_amount += $child_order->total_price;
            }

            // Save parent order with the total quantity and amount
            $parent_order->quantity = $parent_order_qty;
            $parent_order->total_price = $parent_order_amount;
            $parent_order->save();
        }
    }
}


