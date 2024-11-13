<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $data['orders'] = Order::with(['customer'])
                                ->whereNull('parent_order_id')
                                ->orderBy('id', 'desc')  // Order by id in descending order
                                ->get();

        return view('Backend.Order.index' , $data);

    }

    public function view(Request $request, $id)
    {
        $data['parent_order'] = Order::with(['childOrders.product.category', 'customer'])  // Eager load the relationships
                                        ->where('id', $id)
                                        ->whereNull('parent_order_id')  // Fetch only the specific parent order
                                        ->first();  // Get the first matching record

        if ($data['parent_order']) {
            // Group child orders by product category after retrieving the parent order
            $data['parent_order']->child_orders_grouped = $data['parent_order']->childOrders->groupBy(function ($order) {
                return $order->product->category->name;  // Grouping by product category
            });
        }

        // Now, the $parent_orders collection contains a `child_orders_grouped` attribute for each parent order,
        // which is the child orders grouped by their product category.

        return view('Backend.Order.view' , $data);

    }

    public function create()
    {
        $data['customers'] = Customer::all(); // or with pagination if needed
        $data['products']  = Product::all(); // Load products with necessary relationships if needed

        return view('Backend.Order.create' , $data);
    }

    public function store(Request $request)
    {

         // Validate the incoming data using Validator
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|integer|min:1',
            'order_date' => 'required|date',
            'products' => 'required|array|min:1',  // Ensure at least one product is selected
            'products.*.product_id' => 'required|integer|exists:products,id',  // Each product must exist in the products table
            'products.*.quantity' => 'required|integer|min:1',  // Quantity must be at least 1
        ]);

        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }

        // Fetch all customers and products
        $customers = Customer::all();
        $products = Product::all();

        // Start a transaction to ensure atomicity
        DB::beginTransaction();

        try {
            // Create the parent order
            $parentOrder = new Order;
            $parentOrder->customer_id = $request->customer_id; // Assuming customer_id is passed in the request
            $parentOrder->order_date = $request->order_date;  // Assuming order_date is passed in the request
            $parentOrder->save();

            // Initialize parent order quantity and total price
            $parentOrderQty = 0;
            $parentOrderAmount = 0;

            // Loop through products array from the form request (which is dynamic)
            $productIndex = 0;
            foreach ($request->products as $productData) {
                $product = Product::find($productData['product_id']);
                $quantity = $productData['quantity'];
                $totalPrice = $product->price * $quantity;

                // Create a child order
                $childOrder = new Order;
                $childOrder->parent_order_id = $parentOrder->id;  // Associate child order with parent order
                $childOrder->product_id = $product->id;
                $childOrder->quantity = $quantity;
                $childOrder->total_price = $totalPrice;
                $childOrder->save();

                // Accumulate quantities and total prices for the parent order
                $parentOrderQty += $quantity;
                $parentOrderAmount += $totalPrice;

                $productIndex++;
            }

            // Update the parent order with the accumulated quantities and total amount
            $parentOrder->quantity = $parentOrderQty;
            $parentOrder->total_price = $parentOrderAmount;
            $parentOrder->save();

            // Commit the transaction
            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Order created successfully!');

        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollback();
            return back()->withErrors('Error occurred while creating the order: ' . $e->getMessage());
        }
    }

}
