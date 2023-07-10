<?php

//use App\Http\Controllers\Api\StationOperator\BusController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\Driver\TripsController;
use App\Http\Controllers\Api\V1\MessageController;
use App\Http\Controllers\Api\V1\RouteController;
use App\Http\Controllers\Api\V1\StationOperator\BusController;
use App\Http\Controllers\Api\V1\StationOperator\DriverController;
use App\Http\Controllers\Api\V1\StationOperator\TimeTableController;
use App\Http\Controllers\Api\V1\StationOperator\TripController;
use App\Http\Controllers\Api\V1\ThreadController;
use App\Models\Thread;
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

    Route::apiResource('routes',RouteController::class);
    Route::middleware(['auth:sanctum'])->group(function(){
        Route::apiResource('Threads',ThreadController::class);
        Route::post('Threads-create-show/{user}',[ThreadController::class,'create_show']);
        Route::apiResource('messages',MessageController::class);
    });

    Route::prefix('super-admin')->middleware(['auth:sanctum','role:administrator'])->group(function () {
    
    });
    Route::prefix('admin')->middleware(['auth:sanctum','role:administrator'])->group(function () {
        Route::post('create-bus-station-user',[UserController::class,'Create_Bus_Staton_user']);
    });

    Route::prefix('bus-station')->middleware(['auth:sanctum','role:station_operator'])->group(function () {
        Route::post('create-driver-user-user',[DriverController::class,'Create_driver_st_user']);
        Route::apiResource('drivers',DriverController::class);
        Route::apiResource('buses',BusController::class);
        Route::apiResource('trips',TripController::class);
        Route::apiResource('time-table',TimeTableController::class);
        
        Route::patch('buses-add-driver/{bus}',[BusController::class,'add_or_remove_driver_to_bus_here']);
    
    });

    Route::prefix('driver')->middleware(['auth:sanctum','role:driver'])->group(function () {
        Route::apiResource('trips',TripsController::class);
        Route::patch('trips-status/{trip}',[TripsController::class,'update_status_']);
        Route::patch('trips-location/{trip}',[TripsController::class,'SetLocation']);
    });
    Route::prefix('reg-user')->middleware('auth:sanctum')->group(function () {
    });
});
