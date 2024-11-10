<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Add a foreign key column 'category_id' that references the 'id' column on the 'categories' table
            $table->unsignedBigInteger('category_id')->nullable();

            // Optionally, add a foreign key constraint (assumes 'categories' table exists)
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Remove the foreign key and column
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}
