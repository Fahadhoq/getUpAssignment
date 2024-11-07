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
            $table->index('customer_id');
            $table->index('product_id');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

