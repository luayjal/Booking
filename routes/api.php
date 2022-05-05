<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingsController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\ShopsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
Route::post('forget-password',[AuthController::class,'forget_password']);
Route::post('verification-code',[AuthController::class,'verificationCode']);
Route::post('new-password',[AuthController::class,'newPassword']);

Route::middleware(['auth:sanctum' , 'shop'])->group(function () {
    Route::apiResource('services',ServicesController::class);
});

Route::apiResource('categories',CategoriesController::class);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('get-services',[ServicesController::class,'index']);
    Route::get('get-shops',[ShopsController::class,'index']);
    Route::get('view/{id}/shop',[ShopsController::class,'viewShop']);
    Route::get('show/{user_id}/services',[ServicesController::class,'show']);
    Route::apiResource('bookings',BookingsController::class);
});

