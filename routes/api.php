<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Products\ShowController;
use App\Http\Controllers\Api\V1\Products\IndexController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->as('products:')->group(function () {

    Route::get('/', IndexController::class)
        ->name('index');

    Route::get('{key}', ShowController::class)
        ->name('show');

});
