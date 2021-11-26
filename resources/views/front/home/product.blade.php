@extends('layouts.front')

@section('title', $product->name)

@section('content')
    <div class="col-12">
        <!-- Main Content -->
        <main class="row">
            <div class="col-12 bg-white py-3 my-3">
                <div class="row">

                    <!-- Product Images -->
                    <div class="col-lg-5 col-md-12 mb-3">
                        <div class="col-12 mb-3">
                            <div class="img-large border" style="background-image: url('{{ url('public/images/'.$product->thumbnail) }}')"></div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                @foreach($product->images as $image)
                                <div class="col-sm-2 col-3">
                                    <div class="img-small border" style="background-image: url('{{ url('public/images/'.$image) }}')" data-src="{{ url('public/images/'.$image) }}"></div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Product Images -->

                    <!-- Product Info -->
                    <div class="col-lg-5 col-md-9">
                        <div class="col-12 product-name large">
                            {{ $product->name }}
                            <small>By <a href="{{ route('front.home.brand', $product->brand->slug) }}">{{ $product->brand->name }}</a></small>
                        </div>
                        <div class="col-12 px-0">
                            <hr>
                        </div>
                        <div class="col-12">
                           {!! $product->summary !!}
                        </div>
                    </div>
                    <!-- Product Info -->

                    <!-- Sidebar -->
                    <div class="col-lg-2 col-md-3 text-center">
                        <div class="col-12 sidebar h-100">
                            <div class="row">
                                <div class="col-12">
                                    @empty($product->discount_price)
                                    <span class="detail-price">
                                        Rs. {{ number_format($product->price) }}
                                    </span>
                                    @else
                                    <span class="detail-price">
                                        Rs. {{ number_format($product->discount_price) }}
                                    </span>
                                    <span class="detail-price-old">
                                            Rs. {{ number_format($product->price) }}
                                    </span>
                                    @endempty
                                </div>
                                <div class="col-xl-5 col-md-9 col-sm-3 col-5 mx-auto mt-3">
                                    <div class="mb-3">
                                        <label for="qty">Quantity</label>
                                        <input type="number" id="cart-qty-{{ $product->slug }}" min="1" value="1" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-outline-dark cart-add" type="button" data-url="{{ route('front.cart.store', $product->slug) }}" data-slug="{{ $product->slug }}"><i class="fas fa-cart-plus me-2"></i>Add to cart</button>
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-outline-secondary btn-sm" type="button"><i class="fas fa-heart me-2"></i>Add to wishlist</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar -->

                </div>
            </div>

            <div class="col-12 mb-3 py-3 bg-white text-justify">
                <div class="row">

                    <!-- Details -->
                    <div class="col-md-7">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-uppercase">
                                    <h2><u>Details</u></h2>
                                </div>
                                <div class="col-12" id="details">
                                    {!! $product->details !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Details -->

                    <!-- Ratings & Reviews -->
                    <div class="col-md-5">
                        <div class="col-12 px-md-4 sidebar h-100">

                            <!-- Rating -->
                            <div class="row">
                                <div class="col-12 mt-md-0 mt-3 text-uppercase">
                                    <h2><u>Ratings & Reviews</u></h2>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-4 text-center">
                                            <div class="row">
                                                <div class="col-12 average-rating">
                                                    {{ round($reviews->avg('rating'), 1) }}
                                                </div>
                                                <div class="col-12">
                                                    of {{ $reviews->count() }} reviews
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <ul class="rating-list mt-3">
                                                @foreach($ratings as $key => $value)
                                                <li>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-dark" role="progressbar" style="width: {{ $value }}%;" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="100">
                                                            {{ round($value, 2)}}%</div>
                                                    </div>
                                                    <div class="rating-progress-label">
                                                        {{ $key }}<i class="fas fa-star ms-1"></i>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Rating -->

                            <div class="row">
                                <div class="col-12 px-md-3 px-0">
                                    <hr>
                                </div>
                            </div>

                            <!-- Add Review -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>Add Review</h4>
                                </div>
                                <div class="col-12">
                                    @auth()
                                    <form action="{{ route('front.home.review', $product->slug) }}" method="post">
                                        @csrf
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
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-outline-dark">Add Review</button>
                                        </div>
                                    </form>
                                    @else
                                    <div class="col-12 text-center fst-italic py-2 px-3 mb-3 bg-gray">
                                        Please <a href="{{ route('login') }}">login</a> to add your review.
                                    </div>
                                    @endauth
                                </div>
                            </div>
                            <!-- Add Review -->

                            <div class="row">
                                <div class="col-12 px-md-3 px-0">
                                    <hr>
                                </div>
                            </div>

                            <!-- Review -->
                            <div class="row">
                                <div class="col-12">

                                    @if($reviews->isNotEmpty())
                                    @foreach($reviews as $review)
                                    <!-- Comments -->
                                    <div class="col-12 text-justify py-2 px-3 mb-3 bg-gray">
                                        <div class="row">
                                            <div class="col-12">
                                                <strong class="me-2">{{ $review->user->full_name }}</strong>
                                                <small>
                                                    @for($i = 1; $i <= 5; $i++)
                                                    <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                                    @endfor
                                                </small>
                                            </div>
                                            <div class="col-12">
                                                {{ $review->comment }}
                                            </div>
                                            <div class="col-12">
                                                <small>
                                                    <i class="fas fa-clock me-2"></i>{{ $review->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Comments -->
                                    @endforeach
                                    @else
                                    <div class="col-12 text-center fst-italic py-2 px-3 mb-3 bg-gray">
                                        No reviews added yet for this product.
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Review -->

                        </div>
                    </div>
                    <!-- Ratings & Reviews -->

                </div>
            </div>

            @if($similarProducts->isNotEmpty())
            <!-- Similar Product -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 py-3">
                        <div class="row">
                            <div class="col-12 text-center text-uppercase">
                                <h2>Similar Products</h2>
                            </div>
                        </div>
                        <div class="row">

                            @foreach($similarProducts as $similar)
                            <!-- Product -->
                            <div class="col-lg-3 col-sm-6 my-3">
                                <div class="col-12 bg-white text-center h-100 product-item">
                                    <div class="row h-100">
                                        <div class="col-12 p-0 mb-3">
                                            <a href="{{ route('front.home.product', $similar->slug) }}">
                                                <div class="product-image" style="background-image: url({{ url('public/images/'.$similar->thumbnail) }})"></div>
                                            </a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <a href="{{ route('front.home.product', $similar->slug) }}" class="product-name">{{ $similar->name }}</a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            @empty($similar->discount_price)
                                            <span class="product-price">
                                                Rs. {{ number_format($similar->price) }}
                                            </span>
                                            @else
                                            <span class="product-price-old">
                                                Rs. {{ number_format($similar->price) }}
                                            </span>
                                            <br>
                                            <span class="product-price">
                                                Rs. {{ number_format($similar->discount_price) }}
                                            </span>
                                            @endempty
                                        </div>
                                        <div class="col-12 mb-3 align-self-end">
                                            <button class="btn btn-outline-dark cart-add" type="button" data-url="{{ route('front.cart.store', $similar->slug) }}" data-slug="{{ $similar->slug }}"><i class="fas fa-cart-plus me-2"></i>Add to cart</button>
                                            <input type="hidden" id="cart-qty-{{ $similar->slug }}" value="1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Product -->
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <!-- Similar Products -->
            @endif

        </main>
        <!-- Main Content -->
    </div>
@endsection
