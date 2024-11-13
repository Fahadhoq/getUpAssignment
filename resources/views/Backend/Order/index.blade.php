@extends('layouts.MasterDashboard')

@section('css')
<!-- Include necessary datatable and custom CSS -->
@include('layouts.partials.datatable-css')

@endsection

@section('container')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Orders List</h4>
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
                        
        
                            <!-- message show -->
                            @include('layouts.partials.message-show')
                            <!-- message show end -->

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th style=text-align:center>SL</th>
                                                <th style=text-align:center>ID</th>
                                                <th style=text-align:center>Date</th>
                                                <th style=text-align:center>Customer Name</th>
                                                <th style=text-align:center>Quantity</th>
                                                <th style=text-align:center>Amount</th>
                                                <th style=text-align:center>Action</th>    
                                            </tr>
                                        </thead>


                                        <tbody>
                                        @php $i=1 @endphp
                                        @foreach($orders as $order)
                                            <tr>
                                                <td style=text-align:center scope="row">{{$i++}}</td>   
                                                <td style=text-align:center>{{$order->id}}</td>
                                                <td style="text-align:center">{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
                                                <td style=text-align:center>{{$order->customer->name}}</td>
                                                <td style=text-align:center>{{$order->quantity}}</td>
                                                <td style=text-align:center>{{$order->total_price}}</td>

                                                <td style=text-align:center>
                                                    <a href="{{ route('order.view' , $order->id) }}" class="btn btn-info btn-sm" title="View Order"><i class="fa fa-eye"></i></a>
                                                </td> 
                                            </tr>
                                        @endforeach    
                                        </tbody>
                            </table>

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
