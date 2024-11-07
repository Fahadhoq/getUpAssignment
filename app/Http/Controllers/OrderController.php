<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use DB;

class OrderController extends Controller
{
    public function topSellingProducts(Request $request)
    {
        $topSellingProducts = Product::select('products.id', 'products.name', DB::raw('SUM(orders.quantity) as total_sales'))->join('orders', 'products.id', '=', 'orders.product_id')
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('total_sales')
                    ->limit(5)
                    ->get();

        return response()->success(['topSellingProducts' => $topSellingProducts, 'status'=> true]);
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
