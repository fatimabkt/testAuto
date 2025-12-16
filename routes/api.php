<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('products', ProductController::class);
});