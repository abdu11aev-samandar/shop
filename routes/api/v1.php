<?php

use App\Http\Controllers\Api\V1\Products\IndexController;
use App\Http\Controllers\Api\V1\Products\ShowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->as('products:')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/{product}', [ShowController::class, 'show'])->name('show');
});
