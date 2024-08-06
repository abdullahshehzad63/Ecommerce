@extends('admin.include.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Attribute</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('attributeValues.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>

    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" id="attributeValueForm" name="attributeValueForm" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Size</label>
                                            <input type="text" name="size" id="size" class="form-control"
                                                placeholder="Size">
                                                <p></p>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Color</label>
                                            <input type="text" name="color" id="color" class="form-control"
                                                placeholder="Color">
                                                <p></p>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Material</label>
                                            <input type="text" name="material" id="material" class="form-control"
                                                placeholder="Material">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
                <div class="pb-5 pt-3">
                    <button class="btn btn-primary">Create</button>
                    <a href="{{ route('attributeValues.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection
@section('customJs')
    <script>
        $("#attributeValueForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);

            $.ajax({
                url: '{{ route("attributeValues.store") }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {
                        $("#size").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");
                        $("#color").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");
                        $("#material").removeClass("is-invalid").siblings('p').removeClass('invalid-feedback').html("");

                        $('#attributeValueForm')[0].reset();
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
                        if (errors['material']) {
                            $("#material").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html("");
                        } else {
                            $('#material').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html(errors['material'])
                        }

                    }
                }
            })
        })
    </script>
@endsection
