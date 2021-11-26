@extends('layouts.back')

@section('title', 'Categories')

@section('nav')
    @include('back.templates.nav',['active'=> 'categories'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h1>
                        Categories
                    </h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('back.categories.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Add Category
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($categories->isNotEmpty())
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
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-{{ $category->status == 'Active' ? 'success': 'danger' }}">{{ $category->status }}</span>
                                    </td>
                                    <td>{{ $category->created_at->toDayDateTimeString() }}</td>
                                    <td>{{ $category->updated_at->toDayDateTimeString() }}</td>
                                    <td>
                                        <form action="{{ route('back.categories.destroy', $category->slug) }}" method="post">
                                            @method(('DELETE'))
                                            @csrf
                                            <a href="{{ route('back.categories.edit', $category->slug) }}" class="btn btn-outline-primary btn-sm me-2">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a>
                                            <button type="submit" class="btn btn-outline-danger btn-sm delete-item"> <i class="fas fa-times me-2"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    @else
                        <h5 class="text-muted fst-italic">No category added yet.</h5>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
