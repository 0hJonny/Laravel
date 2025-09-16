<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationApiController;
use App\Http\Controllers\ReaderApiController;
use App\Http\Controllers\LoanApiController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
     Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::apiResource('publications', PublicationApiController::class)
         ->only(['index','show']);

    Route::apiResource('readers', ReaderApiController::class)
         ->only(['index','show']);
    
});

Route::apiResource('loans', LoanApiController::class)->only(['index','show']);


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
