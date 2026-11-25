<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

Route::get('/', [CatalogController::class, 'home'])->name('home');
Route::get('/shop', [CatalogController::class, 'index'])->name('shop');
Route::get('/search', [CatalogController::class, 'index'])->name('search');
Route::get('/about-us', fn () => view('about-us'))->name('about-us');
Route::get('/contact-us', fn () => view('contact-us'))->name('contact-us');
Route::post('/contact-us', function (Request $request) {
    $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'comment' => ['required', 'string', 'max:5000'],
    ]);

    return back()->with('status', 'Votre message a ete envoye.');
})->name('contact.store');

Route::post('/newsletter', function (Request $request) {
    $request->validate(['email' => ['required', 'email', 'max:255']]);

    return back()->with('status', 'Vous avez ete inscrit a la newsletter.');
})->name('newsletter.subscribe');

Route::post('/coupon', function (Request $request) {
    $request->validate(['coupon' => ['nullable', 'string', 'max:100']]);

    return back()->withErrors(['coupon' => 'Ce code promo nest pas valide.']);
})->name('coupon.apply');
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/thankyou', [OrderController::class, 'thankyou'])->name('thankyou');
    Route::get('/order-tracking', [OrderController::class, 'track'])->name('order-tracking');
    Route::get('/orders', [OrderController::class, 'history'])->name('orders.history');
});
Route::get('/blog', fn () => view('blog'))->name('blog');
Route::get('/blog/details', fn () => view('blog.details'))->name('blog.details');
Route::post('/blog/comment', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'comment' => ['required', 'string', 'max:5000'],
    ]);

    return back()->with('status', 'Votre commentaire a ete envoye.');
})->name('blog.comment');
Route::middleware('auth')->group(function () {
    Route::get('/my-account', fn (Request $request) => view('my-account', [
        'addresses' => $request->user()->addresses()->latest()->get(),
    ]))->name('my-account');
    Route::put('/my-account/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/my-account/password', [AuthController::class, 'updatePassword'])->name('password.update');
    Route::post('/my-account/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::put('/my-account/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/my-account/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
});
Route::get('/wishlist', fn () => redirect()->route('wishlist.list'))->middleware('auth')->name('wishlist');
Route::get('/wishlist/list', [WishlistController::class, 'index'])->middleware('auth')->name('wishlist.list');
Route::post('/wishlist', [WishlistController::class, 'store'])->middleware('auth')->name('wishlist.store');
Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy'])->middleware('auth')->name('wishlist.destroy');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::put('/cart/items/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/items/{item}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/product/{slug?}', [CatalogController::class, 'show'])
    ->name('product.details');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', AdminProductController::class)->except(['show']);
        Route::get('categories', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::post('categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::delete('categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('customers', [AdminCustomerController::class, 'index'])->name('customers.index');
        Route::put('customers/{customer}', [AdminCustomerController::class, 'update'])->name('customers.update');
        Route::delete('customers/{customer}', [AdminCustomerController::class, 'destroy'])->name('customers.destroy');
        Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::put('orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
    });
