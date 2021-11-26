<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('status', 'Active')->where('featured', 'Yes')->latest()->limit(4)->get();

        $latestProducts = Product::where('status', 'Active')->latest()->limit(4)->get();

        $topSellingProducts = Product::where('status', 'Active')->withCount('order_details')->orderBy('order_details_count', 'desc')->limit(4)->get();

        return view('front.home.index', compact('featuredProducts', 'latestProducts', 'topSellingProducts'));
    }

    public function category(Category $category)
    {
        $products= $category->products()->where('status', 'Active')->latest()->paginate(24);

        return view('front.home.category', compact('category', 'products'));
    }

    public function brand(Brand $brand)
    {
        $products= $brand->products()->where('status', 'Active')->latest()->paginate(24);

        return view('front.home.brand', compact('brand', 'products'));
    }

    public function product(Product $product)
    {
        $similarProducts = Product::where('status', 'Active')->where('category_id', $product->category_id)->where('id', '!=', $product->id)->inRandomOrder()->limit(4)->get();

        $reviews = $product->reviews;

        if($reviews->isNotEmpty()) {
            $ratings = [
                '5' => $reviews->where('rating', 5)->count() / $reviews->count() * 100,
                '4' => $reviews->where('rating', 4)->count() / $reviews->count() * 100,
                '3' => $reviews->where('rating', 3)->count() / $reviews->count() * 100,
                '2' => $reviews->where('rating', 2)->count() / $reviews->count() * 100,
                '1' => $reviews->where('rating', 1)->count() / $reviews->count() * 100,
            ];
        }

        else {
            $ratings = [
                '5' => 0,
                '4' => 0,
                '3' => 0,
                '2' => 0,
                '1' => 0,
            ];

        }

        return view('front.home.product', compact('product', 'similarProducts', 'reviews', 'ratings'));
    }

    public function review(Request $request, Product $product)
    {
        $data = $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $data['product_id'] = $product->id;
        $data['user_id'] =Auth::id();

        Review::create($data);

        flash('Thank you for your review and rating.')->success();

        return redirect()->route('front.home.product', $product->slug);
    }

    public function search(Request $request)
    {
        $products = Product::where('status', 'Active')->where(function($query) use ($request) {
            $query->where('name', 'like', '%'.$request->term.'%')
                ->orWhereHas('category', function($query) use ($request) {
                    $query->where('name', 'like', '%'.$request->term.'%');
                })
                ->orWhereHas('brand', function($query) use ($request) {
                    $query->where('name', 'like', '%'.$request->term.'%');
                });
        })->latest()->paginate(24);

        return view('front.home.search', compact('products'));
    }
}
