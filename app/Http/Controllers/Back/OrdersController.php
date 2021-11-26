<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->paginate(10);

        return view('back.orders.index', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('back.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:Processing,Confirmed,Shipping,Delivered,Cancelled'
        ]);

        $order->update($data);

        flash('Order '.$order->status.'.')->success();

        return redirect()->route('back.orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        foreach ($order->details as $detail) {
            $detail->delete();
        }

        $order->delete();

        flash('Order removed.')->success();

        return redirect()->route('back.orders.index');
    }
}
