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
                        @include('front.templates.nav', ['active' => 'orders'])
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center mt-3">
                        <h4>My Orders</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-11 mx-auto">
                        @if($orders->isNotempty())
                            <table class="table table-striped table-hover table-sm">
                                <thead>
                                <tr>
                                    <th>Details</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Ordered On</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <ul>
                                                @foreach($order->details as $detail)
                                                    <li>
                                                        <a href="{{ route('front.home.product', $detail->product->slug) }}">{{ $detail->product->name }}</a> x {{ $detail->qty }} @ Rs. {{ number_format($detail->price) }} = <strong>{{ number_format($detail->amount) }}</strong>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ number_format($order->details->sum('amount') )}}</td>
                                        <td>
                                            <span class="badge rounded-pill bg-{{ $order->status }}">{{ $order->status }}</span>
                                        </td>
                                        <td>{{ $order->created_at->toDayDateTimeString() }}</td>
                                        <td>
                                            @if($order->status == 'Processing')
                                            <form action="{{ route('front.user.order.cancel', $order->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf

                                                <button class="btn btn-outline-danger btn-sm btn-cancel" type="submit">
                                                    <i class="fas fa-times me-2"></i>Cancel
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @else
                            <div class="text-center fst-italic my-3">
                                You have not ordered any product yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </main>
        <!-- Main Content -->
    </div>
@endsection
