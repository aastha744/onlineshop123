@extends('layouts.front')

@section('title', 'User Dashboard')

@section('content')
    <div class="col-12">
        <!-- Main Content -->
        <div class="row">
            <div class="col-12 mt-3 text-center text-uppercase">
                <h2>User Dashboard</h2>
            </div>
        </div>

        <main class="row">
            <div class="col-sm-8 mx-auto bg-white py-3 mb-4">
                <div class="row">
                    <div class="col-12">
                        @include('front.templates.nav', ['active' => 'reviews'])
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center mt-3">
                        <h4>My Reviews</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-11 mx-auto">
                        @if($reviews->isNotempty())
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Comment</th>
                                    <th>Rating</th>
                                    <th>Reviewed On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td><a href="{{ route('front.home.product', $review->product->slug) }}" target="_blank">{{ $review->product->name }}</a></td>
                                    <td>{{ $review->comment }}</td>
                                    <td>{{ $review->rating }}<i class="fas fa-star ms-1"></i></td>
                                    <td>{{ $review->created_at->toDayDateTimeString() }}</td>
                                    <td>
                                        <form action="{{ route('front.user.reviews.destroy', $review->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="btn btn-outline-dark btn-sm edit-review me-2" data-bs-toggle="modal" data-bs-target="#reviewsModal" data-url="{{ route('front.user.reviews.update', $review->id) }}" data-comment="{{ $review->comment }}" data-rating="{{ $review->rating }}">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm delete-review">
                                                <i class="fas fa-times me-2"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @else
                        <div class="text-center fst-italic my-3">
                            You have not reviewed any product yet.
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </main>
        <!-- Main Content -->
    </div>

    <div class="modal fade" id="reviewsModal" tabindex="-1" aria-labelledby="reviewsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" id="review-form">
                    @method('PATCH')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewsModalLabel">Edit Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <textarea  name="comment" id="comment" class="form-control" placeholder="Give your review" required></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex ratings justify-content-end flex-row-reverse">
                                <input type="radio" value="5" name="rating" id="rating-5" required><label
                                    for="rating-5"></label>
                                <input type="radio" value="4" name="rating" id="rating-4" required><label
                                    for="rating-4"></label>
                                <input type="radio" value="3" name="rating" id="rating-3" required><label
                                    for="rating-3"></label>
                                <input type="radio" value="2" name="rating" id="rating-2" required><label
                                    for="rating-2"></label>
                                <input type="radio" value="1" name="rating" id="rating-1" required checked><label
                                    for="rating-1"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Close</button>
                        <button type="submit" class="btn btn-outline-dark"><i class="fas fa-save me-2"></i>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
