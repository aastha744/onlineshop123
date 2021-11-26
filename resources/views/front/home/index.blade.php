@extends('layouts.front')

@section('title', 'Welcome')

@section('content')
    <div class="col-12">
        <!-- Main Content -->
        <main class="row">

            <!-- Slider -->
            <div class="col-12 px-0">
                <div id="slider" class="carousel slide w-100" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#slider" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#slider" data-bs-slide-to="1"></li>
                        <li data-bs-target="#slider" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img src="{{ url('public/images/slider-1.jpg') }}" class="slider-img">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ url('public/images/slider-3.jpg') }}" class="slider-img">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <!-- Slider -->

            <!-- Featured Products -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 py-3">
                        <div class="row">
                            <div class="col-12 text-center text-uppercase">
                                <h2>Featured Products</h2>
                            </div>
                        </div>
                        <div class="row">

                            @foreach($featuredProducts as $product)
                            <!-- Product -->
                            <div class="col-lg-3 col-sm-6 my-3">
                                <div class="col-12 bg-white text-center h-100 product-item">
                                    <div class="row h-100">
                                        <div class="col-12 p-0 mb-3">
                                            <a href="{{ route('front.home.product', $product->slug) }}">
                                                <div class="product-image" style="background-image: url({{ url('public/images/'.$product->thumbnail) }})"></div>
                                            </a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <a href="{{ route('front.home.product', $product->slug) }}" class="product-name">{{ $product->name }}</a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            @empty($product->discount_price)
                                            <span class="product-price">
                                                Rs. {{ number_format($product->price) }}
                                            </span>
                                                @else
                                            <span class="product-price-old">
                                                Rs. {{ number_format($product->price) }}
                                            </span>
                                            <br>
                                            <span class="product-price">
                                                Rs. {{ number_format($product->discount_price) }}
                                            </span>
                                            @endempty
                                        </div>
                                        <div class="col-12 mb-3 align-self-end">
                                            <button class="btn btn-outline-dark cart-add" type="button" data-url="{{ route('front.cart.store', $product->slug) }}" data-slug="{{ $product->slug }}"><i class="fas fa-cart-plus me-2"></i>Add to cart</button>
                                            <input type="hidden" id="cart-qty-{{ $product->slug }}" value="1">
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
            <!-- Featured Products -->

            <div class="col-12">
                <hr>
            </div>

            <!-- Latest Product -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 py-3">
                        <div class="row">
                            <div class="col-12 text-center text-uppercase">
                                <h2>Latest Products</h2>
                            </div>
                        </div>
                        <div class="row">

                        @foreach($latestProducts as $product)
                            <!-- Product -->
                            <div class="col-lg-3 col-sm-6 my-3">
                                <div class="col-12 bg-white text-center h-100 product-item">
                                    <span class="new">New</span>
                                    <div class="row h-100">
                                        <div class="col-12 p-0 mb-3">
                                            <a href="{{ route('front.home.product', $product->slug) }}">
                                                <div class="product-image" style="background-image: url({{ url('public/images/'.$product->thumbnail) }})"></div>
                                            </a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <a href="{{ route('front.home.product', $product->slug) }}" class="product-name">{{ $product->name }}</a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            @empty($product->discount_price)
                                        <span class="product-price">
                                            Rs. {{ number_format($product->price) }}
                                        </span>
                                            @else
                                        <span class="product-price-old">
                                            Rs. {{ number_format($product->price) }}
                                        </span>
                                                <br>
                                        <span class="product-price">
                                            Rs. {{ number_format($product->discount_price) }}
                                        </span>
                                            @endempty
                                        </div>
                                        <div class="col-12 mb-3 align-self-end">
                                            <button class="btn btn-outline-dark cart-add" type="button" data-url="{{ route('front.cart.store', $product->slug) }}" data-slug="{{ $product->slug }}"><i class="fas fa-cart-plus me-2"></i>Add to cart</button>
                                            <input type="hidden" id="cart-qty-{{ $product->slug }}" value="1">
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
            <!-- Latest Products -->

            <div class="col-12">
                <hr>
            </div>

            <!-- Top Selling Products -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 py-3">
                        <div class="row">
                            <div class="col-12 text-center text-uppercase">
                                <h2>Top Selling Products</h2>
                            </div>
                        </div>
                        <div class="row">
                             @foreach($topSellingProducts as $product)
                            <!-- Product -->
                            <div class="col-lg-3 col-sm-6 my-3">
                                <div class="col-12 bg-white text-center h-100 product-item">
                                    <div class="row h-100">
                                        <div class="col-12 p-0 mb-3">
                                            <a href="{{ route('front.home.product', $product->slug) }}">
                                                <div class="product-image" style="background-image: url({{ url('public/images/'.$product->thumbnail) }})"></div>
                                            </a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <a href="{{ route('front.home.product', $product->slug) }}" class="product-name">{{ $product->name }}</a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            @empty($product->discount_price)
                                                <span class="product-price">
                                            Rs. {{ number_format($product->price) }}
                                        </span>
                                            @else
                                                <span class="product-price-old">
                                            Rs. {{ number_format($product->price) }}
                                        </span>
                                                <br>
                                                <span class="product-price">
                                            Rs. {{ number_format($product->discount_price) }}
                                        </span>
                                            @endempty
                                        </div>
                                        <div class="col-12 mb-3 align-self-end">
                                            <button class="btn btn-outline-dark cart-add" type="button" data-url="{{ route('front.cart.store', $product->slug) }}" data-slug="{{ $product->slug }}"><i class="fas fa-cart-plus me-2"></i>Add to cart</button>
                                            <input type="hidden" id="cart-qty-{{ $product->slug }}" value="1">
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
            <!-- Top Selling Products -->

            <div class="col-12 py-3 bg-light d-sm-block d-none">
                <div class="row">
                    <div class="col-lg-3 col ms-auto large-holder">
                        <div class="row">
                            <div class="col-auto ms-auto large-icon">
                                <i class="fas fa-money-bill"></i>
                            </div>
                            <div class="col-auto me-auto large-text">
                                Best Price
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col large-holder">
                        <div class="row">
                            <div class="col-auto ms-auto large-icon">
                                <i class="fas fa-truck-moving"></i>
                            </div>
                            <div class="col-auto me-auto large-text">
                                Fast Delivery
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col me-auto large-holder">
                        <div class="row">
                            <div class="col-auto ms-auto large-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="col-auto me-auto large-text">
                                Genuine Products
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Main Content -->
    </div>
@endsection
