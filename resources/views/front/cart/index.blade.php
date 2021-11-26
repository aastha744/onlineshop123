@extends('layouts.front')

@section('title', 'Shopping Cart')

@section('content')
    <div class="col-12">
        <!-- Main Content -->
        <div class="row">
            <div class="col-12 mt-3 text-center text-uppercase">
                <h2>Shopping Cart</h2>
            </div>
        </div>

        <main class="row">
            <div class="col-12 bg-white py-3 mb-3">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-10 mx-auto table-responsive">
                        @if($cart->isNotEmpty())
                        <form class="row" action="{{ route('front.cart.update') }}" method="post">
                            @method('PATCH')
                            @csrf
                            <div class="col-12">
                                <table class="table table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ url("public/images/{$item['product']->thumbnail}") }}" class="img-fluid img-table">
                                                {{ $item['product']->name }}
                                            </td>
                                            <td>
                                                Rs. {{ number_format($item['price']) }}
                                            </td>
                                            <td>
                                                <input type="number" name="cart[{{ $item['product']->slug }}][qty]" min="1" value="{{ $item['qty'] }}">
                                            </td>
                                            <td>
                                                Rs. {{ number_format($item['amount']) }}
                                            </td>
                                            <td>
                                                <button class="btn btn-link text-danger cart-delete" type="button" data-url="{{ route('front.cart.destroy', $item['product']->slug) }}"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Total</th>
                                            <th>Rs. {{ number_format($cart->sum('amount')) }}</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-12 text-right">
                                <button class="btn btn-outline-secondary me-3" type="submit">Update</button>
                                <a href="{{ route('front.checkout') }}" class="btn btn-outline-success">Checkout</a>
                            </div>
                        </form>
                        @else
                        <div class="text-center fst-italic">
                            Shopping Cart is empty.
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </main>
        <!-- Main Content -->
    </div>
@endsection
