@extends('admin.include.app')
@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Product</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="title">Name</label>
                                        <input tabindex="1" type="text" name="title" id="title" class="form-control" placeholder="Name" value="{{ old('title') }}">
                                        @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="qty">Qty</label>
                                        <input tabindex="2" type="text" name="qty" id="qty" class="form-control" placeholder="Qty" value="{{ old('qty') }}">
                                        @error('qty')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea tabindex="3" name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                                        @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Cover Image:</h2>
                            <div class="mb-3">
                                <label for="cover" class="form-label">Cover Image</label>
                                <input type="file" tabindex="4"  class="form-control" name="cover" id="cover" />
                                @error('cover')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Multiple Images for one product:</h2>
                            <div class="mb-3">
                                <label for="images" class="form-label">Images</label>
                                <input tabindex="5" type="file" class="form-control" name="images[]" multiple id="images" />
                                @error('images')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Product category</h2>
                            <div class="mb-3">
                                <label for="category">Category</label>
                                <select tabindex="6" name="category" id="category" class="form-control">
                                    <option value="">Select Category</option>
                                    @if ($categories->isNotEmpty())
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('category')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary" tabindex="7">Create</button>
                <a href="{{ route('product.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
@endsection
@section('customJs')
@endsection
