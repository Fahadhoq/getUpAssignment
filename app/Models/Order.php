<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Table name if it's not the plural form of the model name
    protected $table = 'orders';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity',
        'total_price',
    ];

    /**
     * Get the customer that owns the order.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the product that is part of the order.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function childOrders()
    {
        return $this->hasMany(Order::class, 'parent_order_id');  // Foreign key: parent_order_id
    }
}

