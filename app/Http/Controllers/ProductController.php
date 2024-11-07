<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return response()->success(Product::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);
    
        
        if ($validator->fails()) {
            return response()->error('Validation failed', 422, $validator->errors());
        }

        DB::beginTransaction();
        try {
            $product = Product::create($validator->validated());
            DB::commit();
            return response()->success(['product' => $product, 'message' => 'Product Successfully Create', 'status'=> true]);
        } catch(\Exception $exception){
            DB::rollback();
            return response()->error('Product Not Create', 422, $exception->getMessage());
        }
        
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->success(['message' => 'Product Not Found', 'status'=> true]);
        }else{
            return response()->success(['product' => $product, 'status'=> true]);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->success(['message' => 'Product Not Found', 'status'=> true]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products,name,'.$id,
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->error('Validation failed', 422, $validator->errors());
        }

        DB::beginTransaction();
        try {
            $product = $product->update($validator->validated());
            DB::commit();
            return response()->success(['product' => $product, 'message' => 'Product Successfully Update', 'status'=> true]);
        } catch(\Exception $exception){
            DB::rollback();
            return response()->error('Product Not Update', 422, $exception->getMessage());
        }

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->success(['message' => 'Product Not Found', 'status'=> true]);
        }else{
            $product->delete();
            return response()->success(['message' => 'Product Successfully Delete', 'status'=> true]);
        }
    }
}

