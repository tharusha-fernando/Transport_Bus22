<?php

use App\Http\Controllers\Api\V1\Admin\UserController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\StationOperator\DriverController;
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

Route::prefix('v1')->group(function () {

    Route::post('login',[AuthController::class,'login']);

    Route::prefix('super-admin')->middleware(['auth:sanctum','role:administrator'])->group(function () {
    
    });
    Route::prefix('admin')->middleware(['auth:sanctum','role:administrator'])->group(function () {
        Route::post('create-bus-station-user',[UserController::class,'Create_Bus_Staton_user']);
    });

    Route::prefix('bus-station')->middleware(['auth:sanctum','role:station_operator'])->group(function () {
        Route::post('create-driver-user-user',[DriverController::class,'Create_driver_st_user']);
    
    });

    Route::prefix('driver')->middleware(['auth:sanctum'])->group(function () {
    });
    Route::prefix('reg-user')->middleware('auth:sanctum')->group(function () {
    });
});
