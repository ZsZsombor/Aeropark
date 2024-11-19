<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/permits', [PermitController::class, 'index'])->name('permits.index');
    Route::post('/permits', [PermitController::class, 'store'])->name('permits.store');
    Route::post('/permits/{permit}/documents', [PermitController::class, 'uploadDocument'])->name('permits.upload-document');
    
    Route::middleware('admin')->group(function () {
        Route::get('/admin/permits', [AdminController::class, 'index'])->name('admin.permits');
        Route::patch('/admin/permits/{permit}', [AdminController::class, 'update'])->name('admin.permits.update');
    });
});