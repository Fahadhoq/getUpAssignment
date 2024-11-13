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
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Create Order</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ config('app.name') }}</a></li>
                            <li class="breadcrumb-item active">Create Order</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page-title -->

            <!-- main container start -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30 shadow-sm">
                        <div class="card-body">

                            <!-- message show -->
                            @include('layouts.partials.message-show')
                            <!-- message show end -->

                            <form action="{{ route('order.create') }}" method="post" id="order-form">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customer_id" class="font-weight-bold">Customer</label>
                                            <select class="form-control" name="customer_id" id="customer_id">
                                                <option value="0">Select Customer</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order_date" class="font-weight-bold">Order Date</label>
                                            <input type="date" class="form-control" name="order_date" value="{{ old('order_date') }}" placeholder="Enter Order Date">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Products</label>
                                    <div id="product-container">
                                        <div class="product-row mb-3 border p-3 rounded shadow-sm">
                                            <div class="row align-items-center">
                                                <div class="col-md-5">
                                                    <select class="form-control product-select" name="products[0][product_id]">
                                                        <option value="0">Select Product</option>
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control unit-price" placeholder="Unit Price" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control" name="products[0][quantity]" placeholder="Quantity" min="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control total-price" placeholder="Total Price" readonly>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-danger remove-product">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="add-product">
                                        <i class="fas fa-plus"></i> Add Product
                                    </button>
                                </div>

                                <div class="form-group text-center">
                                    <h5 class="font-weight-bold">Total Order Price: $<span id="order-total">0.00</span></h5>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-check-circle"></i> Submit Order
                                    </button>
                                    <a href="{{ route('orders.index') }}" class="btn btn-danger btn-lg ml-3">
                                        <i class="fas fa-times-circle"></i> Cancel
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- main container end -->
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->

@endsection

@section('jquery')
@include('layouts.partials.datatable-js')
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
    let productIndex = 1;

    // Function to update the total order price
    function updateOrderTotal() {
        let total = 0;
        $('#product-container .product-row').each(function() {
            let totalPrice = parseFloat($(this).find('.total-price').val()) || 0;
            total += totalPrice;
        });
        $('#order-total').text(total.toFixed(2));
    }

    // Add Product functionality with validation
    $('#add-product').click(function() {
        // Validate that the last added product row has a product selected and quantity entered
        let lastProductRow = $('#product-container .product-row').last();
        let productSelected = lastProductRow.find('.product-select').val();
        let quantityEntered = lastProductRow.find('input[name*="[quantity]"]').val();

        // If product or quantity is missing, show an alert or error
        if (productSelected == 0 || quantityEntered == "" || quantityEntered <= 0) {
            alert('Please select a product and enter a valid quantity before adding another product.');
            return;
        }

        // If all required fields are filled, add a new product row
        let newProductRow = `
            <div class="product-row mb-3 border p-3 rounded shadow-sm">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <select class="form-control product-select" name="products[${productIndex}][product_id]">
                            <option value="0">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control unit-price" placeholder="Unit Price" readonly>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="products[${productIndex}][quantity]" placeholder="Quantity" min="1">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control total-price" placeholder="Total Price" readonly>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-product">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        $('#product-container').append(newProductRow);
        productIndex++;
    });

    // Update unit price when product is selected
    $('#product-container').on('change', '.product-select', function() {
        let price = $(this).find(':selected').data('price');
        $(this).closest('.product-row').find('.unit-price').val(price);
        updateOrderTotal();
    });

    // Calculate total price when quantity is entered
    $('#product-container').on('input', 'input[name*="[quantity]"]', function() {
        let row = $(this).closest('.product-row');
        let unitPrice = parseFloat(row.find('.unit-price').val());
        let quantity = parseInt($(this).val());
        let totalPrice = unitPrice * quantity || 0;
        row.find('.total-price').val(totalPrice.toFixed(2));
        updateOrderTotal();
    });

    // Remove product row
    $('#product-container').on('click', '.remove-product', function() {
        $(this).closest('.product-row').remove();
        updateOrderTotal();
    });

    // Validate the form using jQuery Validation
    $('#order-form').validate({
        rules: {
            'customer_id': {
                required: true,
                digits: true,
                min: 1
            },
            'order_date': {
                required: true,
                date: true
            },
            'products[0][product_id]': {
                required: true,
                digits: true,
                min: 1
            },
            'products[0][quantity]': {
                required: true,
                digits: true,
                min: 1
            }
        },
        messages: {
            'customer_id': {
                required: "Please select a customer.",
                digits: "Please select a valid customer.",
                min: "Please select a customer."
            },
            'order_date': {
                required: "Please enter an order date.",
                date: "Please enter a valid date."
            },
            'products[0][product_id]': {
                required: "Please select a product.",
                digits: "Please select a valid product.",
                min: "Please select a product."
            },
            'products[0][quantity]': {
                required: "Please enter a quantity.",
                digits: "Please enter a valid quantity.",
                min: "Please enter a quantity greater than 0."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
@endsection
