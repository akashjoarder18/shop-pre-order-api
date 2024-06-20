<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', ProductController::class);

Route::post('/order', OrderController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware('admin')->group(function () {
        Route::post('/register', RegisterController::class);
        Route::get('/preorders', [PreOrderController::class, 'index']);
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/items/{id}', [PreOrderController::class, 'softDelete']);
        Route::patch('/items/{id}/restore', [PreOrderController::class, 'restore']);
        Route::get('/items/trashed', [PreOrderController::class, 'trashed']);
        
    });
    Route::middleware('manager')->group(function () {
        Route::get('/preorders', [PreOrderController::class, 'index']);
        Route::get('/users', [UserController::class, 'index']);
    });
});

