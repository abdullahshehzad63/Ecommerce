@extends('admin.include.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product Attribute</h1>
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
            <form action="" id="productAttributeForm" name="productAttributeForm" method="post">
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
                                                        <option value="{{ $product->id }}">
                                                            {{ $product->title }}
                                                        </option>
                                                    @endforeach
                                            
                                            </select>
        
                                        </div>
                                    </div>
                                  
    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                                <label for="">Size</label>
                                                <input type="text" name="size" id="size" class="form-control"
                                                placeholder="Size">

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="qty">Selling Price</label>
                                            <input type="text" name="price" id="price" class="form-control"
                                                placeholder="Price">

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="qty">Purchasing Price</label>
                                            <input type="text" name="purchasing_price" id="purchasing_price" class="form-control"
                                                placeholder="Purchasing Price">

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Color</label>
                                            <input type="text" name="color" id="color" class="form-control"
                                                placeholder="Color">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Material</label>
                                            
                                              <input type="text" class="form-control" name="material" id="material" placeholder="Material">
                                        </div>
                                    </div>
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
        
        $("#productAttributeForm").submit(function(event) {
            
            event.preventDefault();
            var element = $(this);

            $.ajax({
                url: '{{ route("productAttribute.store") }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {
                        $("#size").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");
                        $("#color").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");
                        $("#price").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");
                        $("#product_id").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");
                        $("#purchasing_price").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");


                        // $("#size").select2("val",'');
                        $("#size").val(null).trigger("change");
                        $("#color").val(null).trigger('change');
                        $("#material").val(null).trigger("change");
                        $('#productAttributeForm')[0].reset();
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
                            $('#color').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html(errors['color'])
                        }

                    }
                }
            })
        })
    </script>
@endsection
