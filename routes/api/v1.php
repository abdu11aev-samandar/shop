<?php

use App\Http\Controllers\Api\V1\Products\IndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('products')->as('products:')->group(function () {
    Route::get('/', IndexController::class)
        ->name('index');
});
