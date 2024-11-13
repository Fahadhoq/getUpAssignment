@extends('layouts.MasterDashboard')

@section('css')
<!-- Include necessary datatable and custom CSS -->
@include('layouts.partials.datatable-css')
<style>
    .category-header {
        background-color: #f8f9fa;
        font-weight: bold;
        text-align: center;
        padding: 10px;
        border-top: 2px solid #343a40;
        border-bottom: 1px solid #ced4da;
        margin-bottom: 10px;
    }

    .table-category {
        margin-bottom: 20px;
    }

    .no-child-orders {
        text-align: center;
        color: #6c757d;
        margin: 20px 0;
    }
</style>
@endsection

@section('container')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Orders Details by Product Category</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                            <li class="breadcrumb-item active">All Orders</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Main container start -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            @include('layouts.partials.message-show')
                            
                                <div class="order-card mb-4 p-4 border rounded shadow-sm bg-light">
                                    <div class="order-header mb-3">
                                        <h4 class="mb-2 font-weight-bold text-dark">Order ID: {{ $parent_order->id }}</h4>
                                        <div class="customer-details mb-2">
                                            <p class="m-0"><strong>Customer:</strong> <span class="text-primary">{{ $parent_order->customer->name }}</span></p>
                                            <p class="m-0"><strong>Order Date:</strong> <span>{{ $parent_order->created_at->format('Y-m-d h:i:s A') }}
                                            </span></p>
                                        </div>
                                        <div class="order-summary text-muted small">
                                            <p class="m-0"><strong>Total Quantity:</strong> {{ $parent_order->quantity }}</p>
                                            <p class="m-0"><strong>Total Price:</strong> ${{ number_format($parent_order->total_price, 2) }}</p>
                                        </div>
                                    </div>
                                    
                                    @if($parent_order->child_orders_grouped->isEmpty())
                                        <div class="alert alert-info">
                                            No child orders for this parent order.
                                        </div>
                                    @else
                                        @foreach($parent_order->child_orders_grouped as $category => $groupedOrders)
                                            <div class="category-section mb-4">
                                                <h5 class="category-header text-primary mb-2">
                                                    Category: {{ ucwords(str_replace(['_', '-'], ' ', $category)) }}
                                                </h5>
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-hover table-striped table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>SL</th>
                                                                <th>Product Name</th>
                                                                <th>Description</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Total Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php 
                                                            $i = 1; 
                                                            $child_total_qty = 0; 
                                                            $child_total_amount = 0; 
                                                            @endphp
                                                            @foreach($groupedOrders as $order)
                                                                <tr>
                                                                    <td>{{ $i++ }}</td>
                                                                    <td>{{ $order->product->name }}</td>
                                                                    <td>{{ Str::limit($order->product->description, 50) }}</td>
                                                                    <td>${{ number_format($order->product->price, 2) }}</td>
                                                                    <td>{{ $order->quantity }}</td>
                                                                    <td>${{ number_format($order->total_price, 2) }}</td>
                                                                </tr>
                                                                @php
                                                                    $child_total_qty += $order->quantity; 
                                                                    $child_total_amount += $order->total_price; 
                                                                @endphp
                                                            @endforeach
                                                            <tr class="font-weight-bold">
                                                                <td colspan="4" class="text-right">Total</td>
                                                                <td>{{ $child_total_qty }}</td>
                                                                <td>${{ number_format($child_total_amount, 2) }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main container end -->
        </div>
    </div>
</div>
@endsection

@section('jquery')
@include('layouts.partials.datatable-js')
@endsection

@section('script')
<script>
    // Custom script if needed
</script>
@endsection
