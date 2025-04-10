<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

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






Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');
Route::get('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::post('/order/add-to-cart/{menuItem}', [OrderController::class, 'addToCart'])->name('order.addToCart');
Route::get('/order/store/{restaurantId}', [OrderController::class, 'store'])->name('order.store'); // Xem giỏ hàng
Route::post('/order/place/{restaurantId}', [OrderController::class, 'place'])->name('order.place'); // Đặt hàng
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show.order'); // Xem chi tiết đơn hàng
require __DIR__ . '/auth.php';
