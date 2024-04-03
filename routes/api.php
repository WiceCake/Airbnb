<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\BookingController;
use App\Http\Controllers\Api\v1\PropertyController;
use App\Http\Controllers\Api\v1\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->middleware('json')->group(function(){
    
    Route::resource('/listings', PropertyController::class);

    Route::middleware('auth.token')->group(function(){
        Route::post('/users/{user_id}/bookings', [BookingController::class, 'makeBooking']);
        Route::get('/users/{user_id}/reservations', [BookingController::class, 'show']);
        Route::post('/users/{user_id}/reviews', [BookingController::class, 'review']);
        Route::get('/users/user', [BookingController::class, 'showProfile']);
        Route::put('/reviews/{booking_id}', [ReviewController::class, 'cancel']);
    });

    Route::prefix('/auth')->group(function(){
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.token');
    });
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
