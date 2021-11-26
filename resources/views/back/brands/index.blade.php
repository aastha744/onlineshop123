@extends('layouts.back')

@section('title', 'Brands')

@section('nav')
    @include('back.templates.nav',['active'=> 'brands'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h1>
                        Brands
                    </h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('back.brands.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Add Brand
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($brands->isNotEmpty())
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->slug }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-{{ $brand->status == 'Active' ? 'success': 'danger' }}">{{ $brand->status }}</span>
                                    </td>
                                    <td>{{ $brand->created_at->toDayDateTimeString() }}</td>
                                    <td>{{ $brand->updated_at->toDayDateTimeString() }}</td>
                                    <td>
                                        <form action="{{ route('back.brands.destroy', $brand->slug) }}" method="post">
                                            @method(('DELETE'))
                                            @csrf
                                            <a href="{{ route('back.brands.edit', $brand->slug) }}" class="btn btn-outline-primary btn-sm me-2">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a>
                                            <button type="submit" class="btn btn-outline-danger btn-sm delete-item"> <i class="fas fa-times me-2"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $brands->links() }}
                    @else
                        <h5 class="text-muted fst-italic">No brand added yet.</h5>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

