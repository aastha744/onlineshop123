<?php

use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Back\BrandsController;
use App\Http\Controllers\Back\CategoriesController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\OrdersController;
use App\Http\Controllers\Back\PasswordController;
use App\Http\Controllers\Back\ProductsController;
use App\Http\Controllers\Back\ProfileController;
use App\Http\Controllers\Back\ReviewsController;
use App\Http\Controllers\Back\StaffController;
use App\Http\Controllers\Back\UsersController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::prefix('cms')->group(function () {

    Route::name('back.')->group(function () {

        Route::middleware('auth:admin')->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

            Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

            Route::get('/edit-profile', [ProfileController::class,'edit'])->name('profile.edit');

            Route::patch('/edit-profile', [ProfileController::class,'update'])->name('profile.update');

            Route::get('/change-password',[PasswordController::class, 'edit'])->name('password.edit');

            Route::patch('/change-password',[PasswordController::class, 'update'])->name('password.update');

            Route::resource('/staffs', StaffController::class)->except('show')->middleware('admin-access');

            Route::resource('/categories', CategoriesController::class)->except('show');

            Route::resource('/brands', BrandsController::class)->except('show');

            Route::delete('/products/{product}/{filename}',[ProductsController::class,'destroyImage'])->name('products.image');

            Route::resource('/products', ProductsController::class)->except('show');

            Route::resource('/users', UsersController::class)->except(['show', 'create', 'store']);

            Route::resource('/orders', OrdersController::class)->except(['show', 'create', 'store']);

            Route::resource('/reviews', ReviewsController::class)->only(['index', 'destroy']);

            Route::get('/get-slug', function(Request $request) {
                if($request->filled('s')) {
                    $slug = Str::slug(Str::replace('&', 'and', $request->s));

                    return response($slug)->setStatusCode(200);
                }
                else {
                    return response('Error while getting slug.')->setStatusCode(400);
                }
            })->name('slug');

        });

        Route::get('/login',[LoginController::class, 'showLoginForm'])->name('login.show');

        Route::post('/login', [LoginController::class, 'login'])->name('login.check');

    });

});

Route::middleware('auth')->group(function () {

    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        flash('Your mail has been verified')->success();

        return redirect()->route('front.user.index');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        flash('Verification message sent.')->success();

        return back();
    })->middleware('throttle:6,1')->name('verification.resend');

});

Route::name('front.')->group(function() {

    Route::middleware(['auth', 'verified'])->group(function() {

        Route::get('/user/edit-profile', [UserController::class, 'edit_profile'])->name('user.profile.edit');

        Route::patch('/user/edit-profile', [UserController::class, 'update_profile'])->name('user.profile.update');

        Route::get('/user/change_password', [UserController::class, 'edit_password'])->name('user.password.edit');

        Route::patch('/user/change_password', [UserController::class, 'update_password'])->name('user.password.update');

        Route::get('/user/reviews', [UserController::class, 'edit_reviews'])->name('user.reviews.edit');

        Route::patch('/user/reviews/{review}', [UserController::class, 'update_reviews'])->name('user.reviews.update');

        Route::delete('/user/reviews/{review}', [UserController::class, 'destroy_reviews'])->name('user.reviews.destroy');

        Route::get('/user',[UserController::class, 'index'])->name('user.index');

        Route::post('/product/{product}', [HomeController::class, 'review'])->name('home.review');

        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

        Route::delete('/user/orders/{order}', [UserController::class, 'cancel'])->name('user.order.cancel');

    });

    Route::get('/category/{category}', [HomeController::class, 'category'])->name('home.category');

    Route::get('/brand/{brand}', [HomeController::class, 'brand'])->name('home.brand');

    Route::get('/product/{product}', [HomeController::class, 'product'])->name('home.product');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::patch('/cart', [CartController::class, 'update'])->name('cart.update');

    Route::get('/cart/total', [CartController::class, 'cart_total'])->name('cart.total');

    Route::delete('/cart/{slug}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/cart/{product}/{qty?}', [CartController::class, 'store'])->name('cart.store');

    Route::get('/search', [HomeController::class, 'search'])->name('home.search');

    Route::get('/', [HomeController::class,'index'])->name('home.index');
});



