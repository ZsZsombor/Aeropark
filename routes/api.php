<?php

use App\Http\Controllers\PermitController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/permits', [PermitController::class, 'index']);
    Route::post('/permits', [PermitController::class, 'store']);
    Route::patch('/permits/{permit}', [PermitController::class, 'update']);
    Route::post('/permits/{permit}/documents', [PermitController::class, 'uploadDocument']);
});