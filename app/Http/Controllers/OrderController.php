<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $data['orders'] =  Order::with(['product.category', 'customer']) // Eager load product and category data to prevent N+1 queries
            ->select(
                'categories.id as category_id',
                'categories.name as category_name',
                DB::raw('COUNT(orders.id) as total_orders'), // Count of orders for the category
                DB::raw('SUM(orders.total_price) as total_revenue') // Total revenue for the category
            )
            ->join('products', 'orders.product_id', '=', 'products.id') // Join with products table
            ->join('categories', 'products.category_id', '=', 'categories.id') // Join with categories table
            ->groupBy('categories.id', 'categories.name') // Group only by category ID and name
            ->orderBy('categories.name') // Order by category name
            ->get();
    
    
        return view('Backend.Order.index' , $data);

    }

    public function recentOrders($customerId)
    {
        $recentOrders = Order::with('product')  // Eager load related product data
            ->where('customer_id', $customerId)  // Filter by customer
            ->orderByDesc('created_at')  // Sort by the most recent
            ->first();

        return response()->json($recentOrders);
    }

    
}
