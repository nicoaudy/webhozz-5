<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
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

# HTTP Verbs
// GET
// POST
// PUT
// PATCH
// DELETE


# FLow
# Routing dapet request dari browser -> AboutController -> Action -> return View

Route::get('/about', [AboutController::class, 'index']);
Route::get('/product', [ProductController::class, 'index']);

// CART
Route::get('carts', [CartController::class, 'index']);
Route::post('/add-to-cart', [CartController::class, 'store']);
Route::delete('/remove-cart/{id}', [CartController::class, 'destroy']);
Route::post('/payment', [PaymentController::class, 'store']);

Route::get('transactions', []);

// ADMIN
Route::resource('/admin/product', 'Admin\\ProductController');

# TODO
// Setup Midtrans
// Bayar Pake midtrans
// Kirim Email
