@extends('admin.include.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product Attribute</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('productAttribute.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>

    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" id="editProductAttributeForm" name="editProductAttributeForm" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="h4 mb-3">Products</h2>
                                        <div class="mb-3">
                                            <label for="product">Products</label>
                                            <select name="product_id" id="product_id" class="form-control">
                                                <option value="">Select Products</option>
                                                
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}" {{($productAttribute->id == $product->id)?'selected' : ""}}  >
                                                            {{ $product->title }}
                                                        </option>
                                                    @endforeach
                                            
                                            </select>
                                            <p></p>
        
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Size</label>
                                                <input type="text" class="size form-control" id="size" value="{{$productAttribute->size}}" class="form-control">
                                                 <p></p>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Color</label>
                                           <input type="text" name="color" class="color form-control" id="color" value="{{$productAttribute->color}}">
                                             <p></p>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Material</label>
                                            <input type="text" name="material" class="material form-control" id="material" value="{{$productAttribute->material}}">
                                             <p></p>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="qty">Price</label>
                                            <input type="text" value="{{$productAttribute->price}}" name="price" id="price" class="form-control"
                                                placeholder="Price">
                                                <p></p>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="qty">Purchasing Price</label>
                                            <input type="text" value="{{$productAttribute->purchasing_price}}" name="purchasing_price" id="purchasing_price" class="form-control"
                                                placeholder="Purchasing Price">
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
                                            <option value="{{ $product->id }}" {{ $productAttribute->product_id == $product->id ? 'selected' : '' }}>
                                                {{ $product->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p></p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button class="btn btn-primary">Create</button>
                    <a href="{{ route('productAttribute.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection
@section('customJs')
    <script>
         
        $("#editProductAttributeForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);

            $.ajax({
                url: '{{ route("productAttribute.update",$productAttribute->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {
                        $("#size").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");
                        $("#color").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");
                        $("#price").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");
                        $("#product_id").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");
                        $("#purchasing_price").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");


                        
                        $('#editProductAttributeForm')[0].reset();
                        
                    } else {
                        var errors = response['errors'];
                        if (errors['size']) {
                            $("#size").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html("");
                        } else {
                            $('#size').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html(errors['size'])
                        }
                        if (errors['color']) {
                            $("#color").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html("");
                        } else {
                            $('#color').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html(errors['color'])
                        }
                        if (errors['price']) {
                            $("#price").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html("");
                        } else {
                            $('#price').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html(errors['price'])
                        }
                        if (errors['purchasing_price']) {
                            $("#purchasing_price").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html("");
                        } else {
                            $('#purchasing_price').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html(errors['purchasing_price'])
                        }
                        if (errors['product_id']) {
                            $("#").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html("");
                        } else {
                            $('#product_id').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html(errors['product_id'])
                        }

                    }
                }
            })
        })
    </script>
@endsection
