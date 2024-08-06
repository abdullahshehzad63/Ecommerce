@extends('admin.include.app')
@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Product Purchase</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('productPurchases.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('productPurchases.store') }}" id="productPurchaseForm" name="productPurchaseForm" method="POST">
            @csrf
            <div id="productFormsContainer">
                <div class="product-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <h2 class="h4 mb-3">Products</h2>
                                        <div class="col-md-12">
                                            <label for="product">Products</label>
                                            <select name="product_id[]" id="productSelect" class="form-control product_id">
                                                <option value="">Select Products</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                                                @endforeach
                                            </select>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Size</th>
                                                        <th>Color</th>
                                                        <th>Selling Price</th>
                                                        <th>Purchasing Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="productDetailsTableBody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                        <a href="{{ route('productPurchases.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customJs')
<script>
    $(document).ready(function() {
        function calculateTotalPrice(form) {
            var quantity = parseFloat(form.find(".quantity").val()) || 0;
            var purchasingPrice = parseFloat(form.find(".purchasing_price").val()) || 0;
            var totalPrice = quantity * purchasingPrice;
            form.find(".total_price").val(totalPrice.toFixed(2));
        }
////
         


        $("#productSelect").change(function() {
            var productId = $(this).val();
            if (productId) {
                $.ajax({
                    url: '{{ url('product-specifications') }}/' + productId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.length > 0) {
                            response.forEach(function(attribute) {
                                var newRow = `
                                    <tr>
                                        <td>${attribute.product ? attribute.product.title : 'N/A'}</td>
                                        <td>${attribute.size ? attribute.size.size : 'N/A'}</td>
                                        <td>${attribute.color ? attribute.color.color : 'N/A'}</td>
                                        <td><input type="number" name="selling_price[]" class="form-control selling_price" value="${attribute.price}" readonly></td>
                                        <td><input type="number" name="purchasing_price[]" class="form-control purchasing_price" value="${attribute.purchasing_price}" readonly></td>
                                        <td><input type="number" name="quantity[]" class="form-control quantity" placeholder="Quantity" value="0"></td>
                                        <td><input type="text" name="total_price[]" class="form-control total_price" placeholder="Total Price" readonly></td>
                                    </tr>
                                `;
                                $("#productDetailsTableBody").append(newRow);
                            });
                        }
                    }
                });
            }
        });


        $("#productFormsContainer").on("input", ".quantity, .purchasing_price", function() {
            var form = $(this).closest('tr');
            calculateTotalPrice(form);
        });
    });
</script>
@endsection

