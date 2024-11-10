@extends('layouts.MasterDashboard')

@section('css')
<!-- Include any necessary datatable CSS -->
@include('layouts.partials.datatable-css')
@endsection

@section('container')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">               
        <div class="container-fluid">

            <!-- Start page-title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Recent Orders</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                            <li class="breadcrumb-item active">Recent Orders</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- End page-title -->

            <!-- Main container start -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <!-- Message show (if any) -->
                            @include('layouts.partials.message-show')

                            <!-- Orders Table -->
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-default">
                                    <tr>
                                        <th style="text-align:center">Order ID</th>
                                        <th style="text-align:center">Customer ID</th>
                                        <th style="text-align:center">Product Name</th>
                                        <th style="text-align:center">Category</th>
                                        <th style="text-align:center">Total Amount</th>
                                        <th style="text-align:center">Created At</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td style="text-align:center">{{ $order->id }}</td>
                                        <td style="text-align:center">{{ $order->customer != null ? $order->customer->name : ''}}</td>
                                        <td style="text-align:center">{{ $order->product != null ? $order->product->name : '' }}</td>
                                        <td style="text-align:center">{{ $order->product != null ? $order->product->category->name : '' }}</td>
                                        <td style="text-align:center">{{ $order->total_price }}</td>
                                        <td style="text-align:center">{{ $order->created_at != null ? $order->created_at->format('Y-m-d H:i:s') : ''}}</td>
                                    </tr>
                                @endforeach    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->

            <!-- Main container end -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->
</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->

@endsection

@section('jquery')
<!-- Include any necessary datatable JS -->
@include('layouts.partials.datatable-js')
@endsection

@section('script')
<script>
    // Any additional custom scripts you may need for the page
</script>
@endsection
