@extends('layouts.back')

@section('title', 'Edit Product')

@section('nav')
    @include('back.templates.nav',['active' => 'products'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-6 mx-auto">
            <div class="row">
                <div class="col">
                    <h1>
                        Edit Product
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('back.products.update', $product->slug) }}" method="post" enctype="multipart/form-data">
                        @method('PATCH');
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control with-slug" data-url="{{ route('back.slug') }}" value="{{ old('name', $product->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $product->slug) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="summary" class="form-label">Summary</label>
                            <textarea name="summary" id="summary" class="form-control with-editor">{{ old('summary', $product->summary) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="details" class="form-label">Details</label>
                            <textarea name="details" id="details" class="form-control with-editor">{{ old('details', $product->details) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="discount_price" class="form-label">Discount Price</label>
                            <input type="number" name="discount_price" id="discount_price" class="form-control" step="0.01" value="{{ old('discount_price', $product->discount_price) }}">
                        </div>
                        <div class="mb-3">
                            <label for="stock_qty" class="form-label">Stock Qty</label>
                            <input type="number" name="stock_qty" id="stock_qty" class="form-control" value="{{ old('stock_qty', $product->stock_qty) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="files" class="form-label">Images</label>
                            <input type="file" name="files[]" id="files" class="form-control" accept="image/*" multiple>
                            <div class="row">
                                @foreach($product->images as $image)
                                <div class="col-4 mt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="img-preview border border-1" style="background-image: url('{{ url('public/images/'.$image) }}')"></div>
                                        </div>
                                        <div class="col-12 mt-3 text-center">
                                            <button type="button" class="btn btn-outline-danger btn-sm delete-image" data-url="{{ route('back.products.image', [$product->slug, $image]) }}">
                                                <i class="fas fa-times me-2"></i>Delete</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row" id="img-container"></div>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-select" required>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active" {{ old('status', $product->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status', $product->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="featured" class="form-label">Featured</label>
                            <select name="featured" id="featured" class="form-select" required>
                                <option value="Yes" {{ old('featured', $product->featured) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ old('featured', $product->featured) == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save me-2"></i>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
