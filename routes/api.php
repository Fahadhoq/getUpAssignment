<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('/assign-role', [AuthController::class, 'assignRole']);

    Route::prefix('product')->group(function () {
        Route::get('/list', [ProductController::class, 'index']);
        Route::post('/create', [ProductController::class, 'store']);
        Route::get('{id}', [ProductController::class, 'show']);
        Route::post('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });

    Route::prefix('order')->group(function () {
        Route::get('/topSellingProducts', [OrderController::class, 'topSellingProducts']);
        Route::get('/recentOrders/{customerId}', [OrderController::class, 'recentOrders']);
    });
});


