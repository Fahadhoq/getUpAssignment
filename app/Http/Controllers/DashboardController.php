<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use DB;

class DashboardController extends Controller
{
    public function index()
    { 
        $data['topSellingProducts'] = Product::select('products.id', 'products.name', DB::raw('SUM(orders.quantity) as total_sales'))->join('orders', 'products.id', '=', 'orders.product_id')
                                    ->groupBy('products.id', 'products.name')
                                    ->orderByDesc('total_sales')
                                    ->limit(5)
                                    ->get();

        $data['recentOrders'] = Order::with('product','customer')
                                    ->whereNull('parent_order_id')
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get();   
    
        return view('Dashboard.dashboard' , $data );
    }

    public function cancle()
    {
        return redirect()->back();
    }
}
