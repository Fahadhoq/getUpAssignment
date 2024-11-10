<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request, Product $product)
    {
        $data['products'] = Product::with('category')->orderBy('id', 'desc')->get();
        
        return view('Backend.Product.index' , $data );
    }

    public function create(){
        $data['categories'] = Category::get();

        return view('Backend.Product.create' , $data);
    }

    public function store(Request $request,Product $product)
    {
        $this->authorize('create', $product);

        if ($request->input('name') === null ) {
            $this->SetMessage('Product name can not be null' , 'danger');
            return redirect()->back()->WithInput();
        }
        if ($request->input('description') === null ) {
            $this->SetMessage('Product description can not be null' , 'danger');
            return redirect()->back()->WithInput();
        }
        if ($request->input('price') === null ) {
            $this->SetMessage('Product price can not be null' , 'danger');
            return redirect()->back()->WithInput();
        }
        if ($request->input('stock') === null ) {
            $this->SetMessage('Product stock can not be null' , 'danger');
            return redirect()->back()->WithInput();
        }

        if ($request->input('category_id') === null ) {
            $this->SetMessage('Product category can not be null' , 'danger');
            return redirect()->back()->WithInput();
        }



        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|integer',
        ]);
    
        
        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }

        DB::beginTransaction();
        try {
            $product = Product::create($validator->validated());
           
            $this->SetMessage('Product Create successfully' , 'success');
            $data['products'] = Product::with('category')->orderBy('id', 'desc')->get();

            DB::commit();
            
            return redirect('/product/list')->with($data);
        } catch(\Exception $exception){
            DB::rollback();
            $this->SetMessage($exception->getMessage() , 'danger');
            return redirect()->back();
        }
        
    }

    // jquery view
    public function show(Request $request,Product $product){
        $this->authorize('view', $product);
  
        $id = $request->id;
         {  
              $output = '';    
              $Product = Product::where('id', $id)->with('category')->first();                     
                                      
              $output .= '  
              <div class="table-responsive">  
                   <table class="table table-bordered">';  
                   $output .= '  
                        <tr>  
                             <td width="30%"><label>id</label></td>  
                             <td width="70%">'.$Product->id.'</td>  
                        </tr>  
                        <tr>  
                             <td width="30%"><label>Name</label></td>  
                             <td width="70%">'.$Product->name.'</td>  
                        </tr>
                        <tr>  
                             <td width="30%"><label>Category</label></td>  
                             <td width="70%">'.$Product->category->name.'</td>
                        </tr>
                       <tr>  
                             <td width="30%"><label>Description</label></td>  
                             <td width="70%">'.$Product->description.'</td>  
                        </tr>
                        <tr>  
                             <td width="30%"><label>Price</label></td>  
                             <td width="70%">'.$Product->price.'</td>  
                        </tr>
                        <tr>  
                            <td width="30%"><label>Stock</label></td>  
                            <td width="70%">'.$Product->stock.'</td>  
                        </tr>
                                      
                        ';
                             
              $output .= "</table></div>";
              

              echo $output;  
         }
    }

    public function edit(Request $request){

        $id = $request->id;
        $data['product'] = Product::where('id', $id)->with('category')->first();
        $data['categories'] = Category::get();
                                                                                  
        return view('Backend.Product.edit' , $data);
    }

    public function update(Request $request, $id,Product $product)
    {
        $this->authorize('update', $product);

        $product = Product::find($id);
        if (!$product) {
            $this->SetMessage('Product Not Found' , 'danger');
        }

        if ($request->input('name') === null ) {
            $this->SetMessage('Product name can not be null' , 'danger');
            return redirect()->back()->WithInput();
        }
        if ($request->input('description') === null ) {
            $this->SetMessage('Product description can not be null' , 'danger');
            return redirect()->back()->WithInput();
        }
        if ($request->input('price') === null ) {
            $this->SetMessage('Product price can not be null' , 'danger');
            return redirect()->back()->WithInput();
        }
        if ($request->input('stock') === null ) {
            $this->SetMessage('Product stock can not be null' , 'danger');
            return redirect()->back()->WithInput();
        }

        if ($request->input('category_id') === null ) {
            $this->SetMessage('Product category can not be null' , 'danger');
            return redirect()->back()->WithInput();
        }


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products,name,'.$id,
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|integer',
        ]);

        if($validator->fails()){
            return redirect()->back()->WithErrors($validator)->WithInput();
        }

        DB::beginTransaction();
        try {
            $product->update($validator->validated());

            $this->SetMessage('Product Update successfully' , 'success');
            $data['products'] = Product::orderBy('id', 'desc')->get();
            DB::commit();
            
            return redirect('/product/list')->with($data);
        } catch(\Exception $exception){
            DB::rollback();
            $this->SetMessage($exception->getMessage() , 'danger');
            return redirect()->back();
        }
    }

    public function destroy($id,Product $product)
    {
        $this->authorize('delete', $product);

        $product = Product::find($id);

        if (!$product) {
            return response()->success(['message' => 'Product Not Found', 'status'=> true]);
        }else{
            $product->delete();
            return response()->success(['message' => 'Product Successfully Delete', 'status'=> true]);
        }
    }

    
}

