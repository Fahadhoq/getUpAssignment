@extends('layouts.MasterDashboard')

@section('container')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <div class="content">               
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
            
            <!-- Top 5 Best-Selling Products Section -->
            <div> 
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-center mb-4 font-weight-bold">Top 5 Best-Selling Products</h4>
                    </div>
                </div>
    
                <div class="row">
                    @foreach($topSellingProducts as $index => $product)
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-lg rounded-lg border-0 mb-4">
                                <div class="card-body p-4">
                                    <!-- Card Header with Product Name -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h5 class="font-16 text-uppercase text-dark">
                                                {{ $product->name }}
                                            </h5>
                                        </div>
                                        <div class="text-center">
                                            <i class="mdi mdi-cube-outline bg-info text-white p-2 rounded-circle"></i>
                                        </div>
                                    </div>
    
                                    <!-- Sales Info -->
                                    <div class="mb-4">
                                        <h3 class="font-weight-bold text-primary">{{ $product->total_sales }} units</h3>
                                        <p class="text-muted">Total Sold</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div> 
                <!-- Recent Orders Section -->
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-center mb-4 font-weight-bold">Most Recent Customer Orders</h4>
                    </div>
                </div>

                <div class="row">
                    @foreach($recentOrders as $order)
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-lg rounded-lg border-0 mb-4">
                                <div class="card-body p-4">
                                    <!-- Card Header with Order Info -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h5 class="font-16 text-dark">
                                                Order #{{ $order->id }} - {{ $order->customer->name }}
                                            </h5>
                                        </div>
                                        <div class="text-center">
                                            <i class="mdi mdi-cart-outline bg-info text-white p-2 rounded-circle"></i>
                                        </div>
                                    </div>

                                    <!-- Order Date and Status -->
                                    <div class="mb-4">
                                        <h6 class="text-muted">Ordered On: {{ $order->created_at->format('M d, Y') }}</h6>
                                    </div>

                                    <!-- Product and Quantity -->
                                    <div class="mt-3">
                                        <p class="text-muted">Quantity: {{ $order->quantity }}</p>
                                    </div>

                                    <!-- Total Amount -->
                                    <div class="mt-3">
                                        <p class="text-muted">Total Amount: ${{ number_format($order->total_price, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->

@endsection
