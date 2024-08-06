@extends('admin.include.app')
@section('content')
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('category.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <form action="" id="editForm" name="editForm">
        @csrf
        @method('PUT')
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" value="{{$categories->name}}" name="name" id="name" class="form-control" placeholder="Name">	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="4">{{$categories->description}}</textarea>
                            </div>
                        </div>									
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{route('category.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </div>
    </form>
  
    <!-- /.card -->
</section>

@endsection
@section('customJs')
    <script>
         $("#editForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $.ajax({
                url: '{{ route("category.update", $categories->id) }}',
                type: 'PUT',
                data: element.serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#description").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        alert('Category updated successfully!');
                        window.location.href = '{{ route("category.index") }}';
                    } else {
                        var errors = response['errors'];
                        if (errors['name']) {
                            $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                        } else {
                            $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        }
                        if (errors['description']) {
                            $("#description").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['description']);
                        } else {
                            $("#description").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        }
                    }
                }
            });
        })
    </script>
@endsection
