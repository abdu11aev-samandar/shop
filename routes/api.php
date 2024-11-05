<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Products\ShowController;
use App\Http\Controllers\Api\V1\Products\IndexController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Product routes
 */

Route::prefix('products')->as('products:')->group(function () {

    Route::get('/', IndexController::class)
        ->name('index');

    Route::get('{key}', ShowController::class)
        ->name('show');

});

/**
 * Cart routes
 */

Route::prefix('cart')->as('carts:')->group(function () {

    Route::get('/', App\Http\Controllers\Api\V1\Carts\IndexController::class)->name('index');

    Route::post('/', App\Http\Controllers\Api\V1\Carts\StoreController::class)->name('store');

    Route::post('{cart:uuid}', App\Http\Controllers\Api\V1\Carts\Products\StoreController::class)->name('products:store');
    //
    //Route::patch('{cart}/products/{cartItem}', App\Http\Controllers\Api\V1\Carts\Products\UpdateController::class)->name('products:update');
    //
    //Route::delete('{cart}/products/{cartItem}', App\Http\Controllers\Api\V1\Carts\Products\DestroyController::class)->name('products:destroy');

});
