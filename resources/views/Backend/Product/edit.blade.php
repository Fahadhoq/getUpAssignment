@extends('layouts.MasterDashboard')

@section('container')

<!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">               
                 <div class="container-fluid">
                    

                    <!-- start page-title -->
                    <div class="page-title-box">
                        
                        <!-- start row -->
                        <div class="row align-items-center">
                            
                            <div class="col-sm-6">
                                <h4 class="page-title">PRODUCT EDIT</h4>
                            </div>
                            
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{ config('app.name') }}</a></li>
                                    <li class="breadcrumb-item active">PRODUCT </li>
                                    <li class="breadcrumb-item active">PRODUCT EDIT</li>
                                </ol>
                            </div>
                       
                        </div>
                        <!-- end row -->
                     </div>
                    <!-- end page-title -->


                    <!-- main contaner start -->
               
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card m-b-30">
                                
                                <div class="card-body">
                                   
                                   
                                    <!-- message show -->
                                    @include('layouts.partials.message-show')
                                    <!-- message show end -->
                            
                            <div class="col-xl-6">
                                <form action="{{ route( 'product.update' , $product->id ) }}" method="post" >
                                @csrf
                                <div class="form-group">
                                    <lable style=font-weight:bold>Name </lable>
                                    <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Enter Product name">
                                </div>

                                <div class="form-group">
                                    <label style="font-weight: bold">Categories List</label></br>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="0">Select One Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <lable style=font-weight:bold>Description </lable>
                                    <textarea class="form-control" name="description" placeholder="Enter Product Description">{{ $product->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <lable style=font-weight:bold>Price </lable>
                                    <input type="number" class="form-control" name="price" value="{{ $product->price }}" placeholder="Enter Product Price" step="0.01" min="0">
                                </div>
                                
                                <div class="form-group">
                                    <lable style=font-weight:bold>Stock </lable>
                                    <input type="number" class="form-control" name="stock" value="{{ $product->stock }}" placeholder="Enter Product Stock" >
                                </div>

            

                                  <div style=text-align:center class="col-xl-12">
                                         <!-- submit button    -->
                                         <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                                        <!-- button end -->
                                        
                                        </form> 
                                        <!-- from end -->

                                        <!-- cancle from -->
                                        <a href="{{ route( 'products.index' ) }}" class="btn btn-danger"> {{ __('cancle') }}</a>
                                        <!-- cancle from end -->
                                    <div> 

                            </div>
                                </div>

                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->


                    <!-- main  contaner end -->
                
                </div>
                <!-- container-fluid -->
            </div>
            <!-- content  -->
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

@endsection        


