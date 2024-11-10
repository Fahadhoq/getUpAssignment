<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('customer_id'); // Foreign key to customers table
            $table->unsignedBigInteger('product_id');  // Foreign key to products table
            $table->integer('quantity'); // Quantity of the product ordered
            $table->decimal('total_price', 10, 2); // Total price for the order
            $table->timestamps(); // created_at and updated_at columns

            // Adding foreign key constraints
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        // Adding indexes for performance optimization
        Schema::table('orders', function (Blueprint $table) {
           // Index on foreign keys to improve JOIN performance
           $table->index('customer_id'); // Speed up queries filtering by customer_id
           $table->index('product_id');  // Speed up queries filtering by product_id

           // Index on created_at for faster date-based filtering (e.g., order history queries)
           $table->index('created_at'); // Speed up queries filtering or sorting by creation date
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

