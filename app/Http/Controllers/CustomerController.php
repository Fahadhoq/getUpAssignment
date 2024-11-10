<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $data['customers'] = Customer::orderBy('id', 'desc')->get();
        
        return view('Backend.Customer.index' , $data );
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
