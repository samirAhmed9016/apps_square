<?php

use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Auth\LocationController;
use App\Http\Controllers\Auth\RegistrationController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/send-otp', [OTPController::class, 'sendOTP']);
Route::post('/verify-otp', [OTPController::class, 'verifyOTP']);
Route::get('/states', [LocationController::class, 'getStates']);
Route::post('/select-location', [LocationController::class, 'storeLocation']);
Route::post('/register', [RegistrationController::class, 'register']);
Route::post('/login', [RegistrationController::class, 'login']);


Route::middleware('auth:sanctum')->post('/logout', [RegistrationController::class, 'logout']);
