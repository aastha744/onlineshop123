@extends('layouts.back')

@section('title', 'Products')

@section('nav')
    @include('back.templates.nav',['active'=> 'products'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h1>
                        Products
                    </h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('back.products.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Add Product
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($products->isNotEmpty())
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Stock Qty</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td>
                                        <img src="{{ url('public/images/'.$product->thumbnail) }}" class="img-small">
                                    </td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>
                                        @empty($product->discount_price)
                                            Rs. {{ number_format($product->price) }}
                                        @else
                                            Rs. {{ number_format($product->discount_price) }}
                                            <small><del>Rs. {{ number_format($product->price) }}</del></small>
                                        @endempty
                                    </td>
                                    <td>{{ $product->stock_qty }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-{{ $product->status == 'Active' ? 'success': 'danger' }}">{{ $product->status }}</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-{{ $product->featured == 'Yes' ? 'success': 'danger' }}">{{ $product->featured }}</span>
                                    </td>
                                    <td>{{ $product->created_at->toDayDateTimeString() }}</td>
                                    <td>{{ $product->updated_at->toDayDateTimeString() }}</td>
                                    <td>
                                        <form action="{{ route('back.products.destroy', $product->slug) }}" method="post">
                                            @method(('DELETE'))
                                            @csrf
                                            <a href="{{ route('back.products.edit', $product->slug) }}" class="btn btn-outline-primary btn-sm me-2">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a>
                                            <button type="submit" class="btn btn-outline-danger btn-sm delete-item"> <i class="fas fa-times me-2"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    @else
                        <h5 class="text-muted fst-italic">No product added yet.</h5>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
