<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // Define the table name if it's different from the plural form of the model name
    protected $table = 'products';

    // Define the fillable attributes
    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id'];

    // Define the relationship with category (Many-to-One)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
