<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\VehicleController;
use App\Http\Controllers\API\ContractController;
use App\Http\Controllers\API\RefinanceApplicationController;
use App\Http\Controllers\API\RebateController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::apiResource('customers', CustomerController::class);
Route::apiResource('vehicles', VehicleController::class);
Route::apiResource('contracts', ContractController::class);
Route::apiResource('refinance-applications', RefinanceApplicationController::class);
Route::apiResource('rebates', RebateController::class);


