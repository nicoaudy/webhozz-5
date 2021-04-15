<?php

use App\Http\Controllers\AboutController;
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

// Controller
// Migration

// Models
// Templating

// CRUD

// Add to cart
// Setup Midtrans

// Bayar Pake midtrans
// Kirim Email
