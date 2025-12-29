<?php

use App\Http\Controllers\API\V1\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('cart', [CartController::class, 'index']);

    Route::post('cart/items/add', [CartController::class, 'store']);

    Route::put('cart/update/{cart_item}', [CartController::class, 'update']);

    Route::delete('cart/remove/{item}', [CartController::class, 'destroy']);
});