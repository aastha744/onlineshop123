@extends('layouts.back')

@section('title', 'Orders')

@section('nav')
    @include('back.templates.nav',['active'=> 'orders'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h1>
                        Orders
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($orders->isNotEmpty())
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Details</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->user->full_name }}</td>
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
                                    <td>{{ $order->updated_at->toDayDateTimeString() }}</td>
                                    <td>
                                        <form action="{{ route('back.orders.destroy', $order->id) }}" method="post">
                                            @method(('DELETE'))
                                            @csrf
                                            <a href="{{ route('back.orders.edit', $order->id) }}" class="btn btn-outline-primary btn-sm me-2">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a>
                                            <button type="submit" class="btn btn-outline-danger btn-sm delete-item"> <i class="fas fa-times me-2"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    @else
                        <h5 class="text-muted fst-italic">No order added yet.</h5>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

