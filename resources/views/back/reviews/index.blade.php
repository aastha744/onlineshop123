@extends('layouts.back')

@section('title', 'Reviews')

@section('nav')
    @include('back.templates.nav',['active'=> 'reviews'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h1>
                        Reviews
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($reviews->isNotEmpty())
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Product</th>
                                <th>Comment</th>
                                <th>Rating</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->user->full_name }}</td>
                                    <td>{{ $review->product->name }}</td>
                                    <td>{{ $review->comment }}</td>
                                    <td>{{ $review->rating }}<i class="fas fa-star ms-1"></i></td>
                                    <td>{{ $review->created_at->toDayDateTimeString() }}</td>
                                    <td>{{ $review->updated_at->toDayDateTimeString() }}</td>
                                    <td>
                                        <form action="{{ route('back.reviews.destroy', $review->id) }}" method="post">
                                            @method(('DELETE'))
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm delete-item"> <i class="fas fa-times me-2"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $reviews->links() }}
                    @else
                        <h5 class="text-muted fst-italic">No review added yet.</h5>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

