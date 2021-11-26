<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->get();

        return view('front.user.index', compact('orders'));
    }

    public function edit_profile()
    {
        $user = Auth::user();
        return view('front.user.profile', compact('user'));
    }

    public function update_profile(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|max:30',
        ]);

        Auth::user()->update($data);

        flash('Profile updated.')->success();

        return redirect()->route('front.user.profile.edit');
    }

    public function edit_password()
    {
        return view('front.user.password');
    }

    public function update_password(Request $request)
    {
        $data = $request->validate([
            'old_password' => 'required|current_password:web',
            'password' => 'required|confirmed'
        ], [
            'old_password.current_password' => 'The old password is incorrect.'
        ]);

        Auth::user()->update($data);

        flash('Password updated.')->success();

        return redirect()->route('front.user.password.edit');
    }

    public function edit_reviews()
    {
        $reviews = Auth::user()->reviews()->latest()->get();

        return view('front.user.reviews', compact('reviews'));
    }

    public function update_reviews(Request $request, Review $review)
    {
        $data = $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $review->update($data);

        flash('Review updated.')->success();

        return redirect()->route('front.user.reviews.edit');
    }

    public function destroy_reviews(Review $review)
    {
        $review->delete();

        flash('Review removed.')->success();

        return redirect()->route('front.user.reviews.edit');
    }

    public function cancel(Order $order)
    {
        if($order->status == 'Processing') {
            $order->update(['status' => 'Cancelled']);

            flash('Your order has been cancelled.')->success();
        }
        else {
            flash('Your order cannot be cancelled.')->error();
        }

        return redirect()->route('front.user.index');
    }
}
