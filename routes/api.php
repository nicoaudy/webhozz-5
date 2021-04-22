<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransNotificationHandlerController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// api/payment-handler
Route::post('/payment-handler', [MidtransNotificationHandlerController::class, 'store']);
