@extends('layouts.back')

@section('title', 'Edit Order')

@section('nav')
    @include('back.templates.nav',['active' => 'orders'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-6 mx-auto">
            <div class="row">
                <div class="col">
                    <h1>Edit Order</h1>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    <div class="row">
                        <div class="col-12">
                            <strong>User</strong>
                        </div>
                        <div class="col-12">
                            {{ $order->user->full_name }}
                        </div>
                    </div>
                </div>
                <div class="col my-3">
                    <div class="row">
                        <div class="col-12">
                            <strong>Address</strong>
                        </div>
                        <div class="col-12">
                            {{ $order->user->address }}
                        </div>
                    </div>
                </div>
                <div class="col my-3">
                    <div class="row">
                        <div class="col-12">
                            <strong>Contact</strong>
                        </div>
                        <div class="col-12">
                            <a href="tel: {{ $order->user->phone }}">{{ $order->user->phone }}</a><br>
                            <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a>
                        </div>
                    </div>
                </div>
                <div class="col my-3">
                    <div class="row">
                        <div class="col-12">
                            <strong>Status</strong>
                        </div>
                        <div class="col-12">
                            <span class="badge rounded-pill bg-{{ $order->status }}">{{ $order->status }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('back.orders.update', $order->id) }}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="mb-3">
                            <table class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->details as $detail)
                                    <tr>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>Rs. {{ number_format($detail->price) }}</td>
                                        <td>{{ $detail->qty }}</td>
                                        <td>Rs. {{ number_format($detail->amount) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end">Total</th>
                                        <th>Rs. {{number_format($order->details->sum('amount'))}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Processing" {{ old('status', $order->status) == 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Confirmed" {{ old('status', $order->status) == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="Shipping" {{ old('status', $order->status) == 'Shipping' ? 'selected' : '' }}>Shipping</option>
                                <option value="Delivered" {{ old('status', $order->status) == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="Cancelled" {{ old('status', $order->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save me-2"></i>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection


