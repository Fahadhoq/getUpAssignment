<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Table name if it's not the plural form of the model name
    protected $table = 'customers';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * Get all the orders for the customer.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

