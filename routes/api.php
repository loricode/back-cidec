<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\Product\ProductController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'signIn']);

Route::post('/recover', [AuthController::class, 'recoverAccount']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/products', [ProductController::class, 'allProducts']);

});

