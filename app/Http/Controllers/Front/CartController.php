<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = [];

        if($request->hasCookie('onlineshop_cart')) {
            $cart = json_decode($request->cookie('onlineshop_cart'), true);
        }

        foreach ($cart as $k => $v) {
            $product = Product::where('slug', $k)->first();

            $cart[$k]['product'] = $product;
        }

        $cart = collect($cart);

        return view('front.cart.index', compact('cart'));
    }

    public function store(Request $request, Product $product, $qty = 1 )
    {
        $cart = [];

        if($request->hasCookie('onlineshop_cart')) {
            $cart = json_decode($request->cookie('onlineshop_cart'), true);
        }

        $price = $product->discount_price ?? $product->price;

        if(array_key_exists($product->slug, $cart)) {
            $qty += $cart[$product->slug]['qty'];
        }

        $cart[$product->slug] = [
            'qty' => $qty,
            'price' => $price,
            'amount' => $price * $qty
        ];

        return response("Product '{$product->name}' added to cart.")->setStatusCode(200)->cookie('onlineshop_cart', json_encode($cart), 30*24*60);
    }

    public function update(Request $request)
    {
        $cart = [];

        if($request->hasCookie('onlineshop_cart')) {
            $cart = json_decode($request->cookie('onlineshop_cart'), true);
        }

        foreach($request->cart as $k => $v) {
            $cart[$k]['qty'] = $v['qty'];
            $cart[$k]['amount'] = $v['qty'] * $cart[$k]['price'];
        }

        flash('Cart updated.')->success();

        return redirect()->route('front.cart.index')->cookie('onlineshop_cart', json_encode($cart), 30*24*60);
    }

    public function destroy(Request $request, $slug)
    {
        $cart = [];

        if ($request->hasCookie('onlineshop_cart')) {
            $cart = json_decode($request->cookie('onlineshop_cart'), true);
        }

        $new = [];

        foreach ($cart as $k => $v) {
            if ($k != $slug) {
                $new[$k] = $v;
            }
        }

        flash('Product removed from cart.')->success();

        if (!empty($new)) {
            return response('Ok')->setStatusCode(200)->cookie('onlineshop_cart', json_encode($new), 30 * 24 * 60);
        }
        else {
            return response('Ok')->setStatusCode(200)->cookie('onlineshop_cart', null, -10);
        }
    }

    public function cart_total(Request $request)
    {
        $cart = [];

        if($request->hasCookie('onlineshop_cart')) {
            $cart = json_decode($request->cookie('onlineshop_cart'), true);
        }

        $cart = collect($cart);

        $total_qty = $cart->sum('qty');
        $total_amount = number_format($cart->sum('amount'));

        return response()->json(compact('total_qty', 'total_amount'))->setStatusCode(200);
    }

    public function checkout(Request $request)
    {
        $cart = [];

        if($request->hasCookie('onlineshop_cart')) {
            $cart = json_decode($request->cookie('onlineshop_cart'), true);
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'Processing',
        ]);

        foreach($cart as $k => $v) {
            $product = Product::where('slug', $k)->first();

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'qty' => $v['qty'],
                'price' => $v['price'],
                'amount' => $v['amount'],
            ]);
        }

        flash('Thank you for your order. Your order is being processed.')->success();

        return redirect()->route('front.user.index')->cookie('onlineshop_cart', null, -10);
    }
}
