@extends('admin.include.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('product.update', $products->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Name</label>
                                            <input type="text" value="{{ $products->title }}" name="title" id="title" class="form-control" placeholder="Name">
                                            @error('title')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="qty">Qty</label>
                                            <input type="text" value="{{ $products->qty }}" name="qty" id="qty" class="form-control" placeholder="Qty">
                                            @error('qty')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Description">{{ $products->description }}</textarea>
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
                                    <input type="file" class="form-control" name="cover" id="cover" />
                                    <img src="{{ asset($products->cover) }}" width="100px" alt="">
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
                                    <input type="file" class="form-control" name="images[]" multiple id="images" />
                                    @if ($products->images)
                                        <div class="image-container">
                                            @foreach ($products->images as $img)
                                                <div class="image-wrapper">
                                                    <img src="{{ asset($img->image) }}" alt="" class="product-image">
                                                    <a href="{{ route('productImage.delete', $img->id) }}" class="btn btn-danger btn-remove">Remove</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
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
                                <h2 class="h4 mb-3">Product Category</h2>
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select Category</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $products->category_id == $category->id ? 'selected' : '' }}>
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
                    <button class="btn btn-primary">Edit</button>
                    <a href="{{ route('product.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customJs')
@endsection
