@extends('admin.include.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product Purchase</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('productPurchases.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" id="editProductPurchaseForm" name="editProductPurchaseForm">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="size">Size</label>
                                            <select class="size w-100 form-control" name="size[]" id="size" multiple>
                                                @foreach ($attributeValues as $attributeValue)
                                                    <option selected value="{{ $attributeValue->id }}">{{ $attributeValue->size }}</option>
                                                @endforeach
                                            </select>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="selling_price">Selling Price</label>
                                            <input type="text" name="selling_price" value="{{$productPurchases->selling_price}}" id="selling_price" class="form-control"
                                                placeholder="Selling Price">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="purchasing_price">Purchasing Price</label>
                                            <input type="text" name="purchasing_price" value="{{$productPurchases->purchasing_price}}" id="purchasing_price" class="form-control"
                                                placeholder="Purchasing Price">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" placeholder="Quantity" value="{{$productPurchases->quantity}}" id="quantity" name="quantity" class="form-control">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="total_price">Total Price</label>
                                            <input type="text" name="total_price" id="total_price" value="{{$productPurchases->totalPrice}}" class="form-control" placeholder="Total Price" readonly>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="color">Color</label>
                                            <select name="color[]" class="form-control w-100" id="color" multiple>
                                                @foreach ($attributeValues as $attributeValue)
                                                    <option selected value="{{ $attributeValue->id }}">{{ $attributeValue->color }}</option>
                                                @endforeach
                                            </select>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="material">Material</label>
                                            <select name="material[]" class="form-control w-100" id="material" multiple>
                                                @foreach ($attributeValues as $attributeValue)
                                                    <option selected value="{{ $attributeValue->id }}">{{ $attributeValue->material }}</option>
                                                @endforeach
                                            </select>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Products</h2>
                                <div class="mb-3">
                                    <label for="product">Products</label>
                                    <select name="product_id" id="product_id" class="form-control">
                                        <option value="">Select Products</option>
                                        @foreach ($products as $product)
                                            <option  value="{{ $product->id }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button class="btn btn-primary">Edit</button>
                    <a href="{{route('productPurchases.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection
@section('customJs')
    <script>
        $(document).ready(function() {
            $("#size").select2();
            $("#color").select2();
            $("#material").select2();

            function calculateTotalPrice() {
                var quantity = parseFloat($("#quantity").val()) || 0;
                var purchasingPrice = parseFloat($("#purchasing_price").val()) || 0;
                var totalPrice = quantity * purchasingPrice;
                $("#total_price").val(totalPrice.toFixed(2));
            }  
   
            $("#quantity, #purchasing_price").on("input", function() {
                calculateTotalPrice();
            });

            $("#editProductPurchaseForm").submit(function(event) {
                event.preventDefault();
                var element = $(this);

                $.ajax({
                    url: '{{ route("productPurchases.update",$productPurchases->id) }}',
                    type: 'put',
                    data: element.serializeArray(),
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] == true) {
                            $(".is-invalid").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");

                            $("#size, #color, #material").val(null).trigger("change");
                            $('#productPurchaseForm')[0].reset();
                            $("#total_price").val('');
                        } else {
                            var errors = response['message'];
                            if (errors['size']) {
                                $("#size").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['size'][0]);
                            } else {
                                $("#size").removeClass('is-invalid').siblings('p').removeClass("invalid-feedback").html("");
                            }
                            if (errors['color']) {
                                $("#color").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['color'][0]);
                            } else {
                                $("#color").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            }
                            if (errors['selling_price']) {
                                $("#selling_price").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['selling_price'][0]);
                            } else {
                                $("#selling_price").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            }
                            if (errors['purchasing_price']) {
                                $("#purchasing_price").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['purchasing_price'][0]);
                            } else {
                                $("#purchasing_price").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            }
                            if (errors['quantity']) {
                                $("#quantity").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['quantity'][0]);
                            } else {
                                $("#quantity").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            }
                            if (errors['product_id']) {
                                $("#product_id").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['product_id'][0]);
                            } else {
                                $("#product_id").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            }
                            if (errors['material']) {
                                $("#material").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['material'][0]);
                            } else {
                                $("#material").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
