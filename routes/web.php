<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PropertyController;

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

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:web')->group(function(){
    Route::get('/', [PropertyController::class, 'index']);
    Route::get('/properties/getAddress', [PropertyController::class, 'getAddress']);
    Route::resource('/properties', PropertyController::class)->except('index')->parameter('property', 'slug');
    Route::post('/properties/{slug}/addPhoto', [PropertyController::class, 'addPhoto']);
    Route::post('/properties/{slug}/addDiscount', [PropertyController::class, 'addDiscount']);
    Route::delete('/properties/{slug}/removeDiscount', [PropertyController::class, 'removeDiscount']);
    Route::put('/properties/{slug}/editDiscount', [PropertyController::class, 'editDiscount']);
    Route::put('/properties/{slug}/editStatus', [PropertyController::class, 'editStatus']);
    Route::get('/properties/{slug}/reviews', [PropertyController::class, 'showAllReviews']);

    
    Route::get('/bookings', [BookingController::class, 'index']);

    Route::get('/logout', [AuthController::class, 'logout']);
});

// Route::resource('properties', PropertyController::class)->parameters(['properties' => 'property']);
