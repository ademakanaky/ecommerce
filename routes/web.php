<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class,'index'])->name('products.index');
    Route::get('/products/{productId}', [ProductController::class,'show'])->name('products.show');
    Route::any('/cart/add/{productId}', [CartController::class,'addToCart'])->name('cart.add');
    Route::any('/cart/remove/{cartItemId}', [CartController::class,'removeFromCart'])->name('cart.remove');
    Route::get('/cart/view', [CartController::class,'viewCart'])->name('cart.view');
    Route::any('/checkout', [CheckoutController::class,'checkout'])->name('checkout');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
