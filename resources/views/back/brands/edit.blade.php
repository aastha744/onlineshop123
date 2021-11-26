@extends('layouts.back')

@section('title', 'Edit Brand')

@section('nav')
    @include('back.templates.nav',['active' => 'brands'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-6 mx-auto">
            <div class="row">
                <div class="col">
                    <h1>
                        Edit Brand
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('back.brands.update', $brand->slug) }}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control with-slug" data-url="{{ route('back.slug') }}" value="{{ old('name', $brand->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $brand->slug) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active" {{ old('status', $brand->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status', $brand->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
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


