<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('/users', [AuthController::class, 'index'])->name('users.index');

    Route::get('/role', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/assign-role', [RoleController::class, 'assignRole'])->name('role.assign');
    Route::post('/assign-role', [RoleController::class, 'storeAssignRole']);

    Route::prefix('product')->group(function () {
        Route::get('/list', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/create', [ProductController::class, 'store']);
        Route::post('show-{id}', [ProductController::class, 'show'])->name('product.view');
        Route::get('/update-{id}', [ProductController::class, 'edit'])->name('product.update');
        Route::post('/update-{id}', [ProductController::class, 'update']);
        Route::post('/delete-{id}', [ProductController::class, 'destroy'])->name('product.delete');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/list', [CustomerController::class, 'index'])->name('customers.index');
    });

    Route::prefix('order')->group(function () {
        Route::get('/list', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/recentOrders/{customerId}', [OrderController::class, 'recentOrders']);
    });
});

require __DIR__.'/auth.php';
