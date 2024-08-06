@extends('admin.include.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
                {{-- <div class="col-sm-6 text-right">
                <a href="create-category.html" class="btn btn-primary">New Category</a>
            </div> --}}
                <!-- Button trigger modal -->
                <!-- Button trigger modal -->
                <form action="" id="categoryForm" name="categoryForm">
                    @csrf
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Create Category
                </button>

                <!-- Modal -->
               
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Category Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Category Name"><p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Category Description</label>
                                            <textarea name="description" class="form-control" id="description" cols="30" rows="4"></textarea>
                                            <p></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <form action="" method="get">
                    @csrf
                    <div class="card-header">
                        <a href="{{route('category.index')}}" class="btn btn-info" >Reset</a>
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input type="text" name="keyword" value="{{Request::get('keyword')}}" class="form-control float-right" placeholder="Search">
    
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($categories as $category)
                            <tr id="category-{{$category->id}}">
                                <td>{{$count}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                
                                <td>
                                    <a href="{{route('category.edit',$category->id)}}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a href="#" onclick="deleteCategory('{{$category->id}}')" class="text-danger w-4 h-4 mr-1">
                                        <svg wire:loading.remove.delay="" wire:target=""
                                            class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path ath fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @php
                                $count++;
                            @endphp

                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{$categories->links()}}
                    {{-- <ul class="pagination pagination m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
    <script>
        $("#categoryForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $.ajax({
                url: '{{ route("category.store") }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("")

                        $("#description").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("")
                        $("#categoryForm")[0].reset();
                    } else {
                        var errors = response['errors'];
                        if (errors['name']) {
                            $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(errors['name']);
                        } else {
                            $("#name").removeClass('is-invalid').siblings('p').removClass('invalid-feedback').html("")
                        }
                        if (errors['description']) {
                            $("#description").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(errors['description']);
                        } else {
                            $("#description").removeClass('is-invalid').siblings('p').removClass('invalid-feedback').html("")
                        }
                    }
                }
            });
        })

    

        function deleteCategory(id)
        {
            var url = '{{route("category.delete","ID")}}';
            var newUrl = url.replace("ID",id);
            if(confirm("Are you sure you want to delete this category ? "))
        {
            $.ajax({
                url:newUrl,
                type:'delete',
                data:{},
                dataType:'json',
                success:function(response)
                {
                    if(response['status'] == true)
                {
                    $("#category-"+id).remove();
                }
                else
                {
                    alert("Category is not deleted Successfully");
                }
                }
            });
        }
        }
    </script>
@endsection
