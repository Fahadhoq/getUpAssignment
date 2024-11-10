<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model
{
    use HasFactory; 
    
    // Define the table name if it's different from the plural form of the model name
    protected $table = 'categories';

    // Define the fillable attributes
    protected $fillable = ['name', 'description'];

    // Define the relationship with products (One-to-Many)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
