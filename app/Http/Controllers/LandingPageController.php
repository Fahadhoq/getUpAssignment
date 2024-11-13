<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use DB;
use Illuminate\Support\Facades\Validator;

class LandingPageController extends Controller
{
    public function welcome(Request $request)
    {
        $data['products']  = Product::select('products.id', 'products.name', DB::raw('SUM(orders.quantity) as total_sales'))->join('orders', 'products.id', '=', 'orders.product_id')
                                    ->groupBy('products.id', 'products.name')
                                    ->orderByDesc('total_sales')
                                    ->limit(10)
                                    ->get();

        return view('welcome',$data);
    }


}
