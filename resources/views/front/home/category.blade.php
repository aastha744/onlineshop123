@extends('layouts.front')

@section('title', 'Category: '.$category->name)

@section('content')
    <div class="col-12">
        <!-- Main Content -->
        <main class="row">

            <!-- Category Products -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 py-3">
                        <div class="row">
                            <div class="col-12 text-center text-uppercase">
                                <h2>{{ $category->name }}</h2>
                            </div>
                        </div>
                        <div class="row">

                            @foreach($products as $product)
                            <!-- Product -->
                            <div class="col-xl-2 col-lg-3 col-sm-6 my-3">
                                <div class="col-12 bg-white text-center h-100 product-item">
                                    <div class="row h-100">
                                        <div class="col-12 p-0 mb-3">
                                            <a href="{{ route('front.home.product', $product->slug) }}">
                                                <div class="product-image small" style="background-image: url({{ url('public/images/'.$product->thumbnail) }})"></div>
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
                                            @endif
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
            <!-- Category Products -->

            <div class="col-12 d-flex justify-content-center">
               {{ $products->links() }}
            </div>

        </main>
        <!-- Main Content -->
    </div>
@endsection
