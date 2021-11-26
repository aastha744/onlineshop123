@extends('layouts.back')

@section('title', 'Add Product')

@section('nav')
    @include('back.templates.nav',['active' => 'products'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-6 mx-auto">
            <div class="row">
                <div class="col">
                    <h1>
                        Add Product
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('back.products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control with-slug" data-url="{{ route('back.slug') }}" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="summary" class="form-label">Summary</label>
                            <textarea name="summary" id="summary" class="form-control with-editor">{{ old('summary') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="details" class="form-label">Details</label>
                            <textarea name="details" id="details" class="form-control with-editor">{{ old('details') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="discount_price" class="form-label">Discount Price</label>
                            <input type="number" name="discount_price" id="discount_price" class="form-control" step="0.01" value="{{ old('discount_price') }}">
                        </div>
                        <div class="mb-3">
                            <label for="stock_qty" class="form-label">Stock Qty</label>
                            <input type="number" name="stock_qty" id="stock_qty" class="form-control" value="{{ old('stock_qty') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="files" class="form-label">Images</label>
                            <input type="file" name="files[]" id="files" class="form-control" accept="image/*" multiple required>
                            <div class="row" id="img-container"></div>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-select" required>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="featured" class="form-label">Featured</label>
                            <select name="featured" id="featured" class="form-select" required>
                                <option value="Yes" {{ old('featured') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ old('featured') == 'No' ? 'selected' : '' }}>No</option>
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
