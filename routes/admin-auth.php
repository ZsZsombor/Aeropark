<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


    
    Route::put('/users/{user}/documents/update-access-card', [DocumentController::class, 'updateAccessCard'])->name('user.update.access_card');
    Route::put('/users/{user}/documents/upload-criminal-record', [DocumentController::class, 'updateCriminalRecord'])->name('user.update.criminal_record');
    Route::get('/user/{user}/documents/download-valid', [DocumentController::class, 'downloadValidDocuments'])->name('user.documents.download-valid');


    // Profile Management
    Route::get('/profile/edit', [AdminController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

    // User Permissions
    Route::get('/users/index', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('users/{user}/edit', [AdminController::class, 'editUserPermissions'])->name('admin.users.edit');
    Route::put('users/{user}/update', [AdminController::class, 'updateUserPermissions'])->name('admin.users.update');
    
    // User Documents
    Route::put('users/{user}/documents/{document}', [DocumentController::class, 'update'])->name('admin.documents.update');

    Route::get('users/{user}/documents/edit', [AdminController::class, 'showUploadedDocumentsForAdmin'])->name('admin.users.documents.edit');
    Route::put('users/{user}/documents/update', [AdminController::class, 'updateUploadedDocumentsForAdmin'])->name('admin.users.documents.update');


    Route::put('password', [PasswordController::class, 'update'])->name('admin.password.update');
    Route::delete('/profile', [AdminController::class, 'destroy'])->name('admin.profile.destroy');


    Route::get('/users/register', [AdminController::class, 'showRegistrationForm'])->name('admin.users.create');
    
    // Store the new user
    Route::post('users/register', [AdminController::class, 'storeUser'])->name('admin.users.store');

    // Logout
    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
});

