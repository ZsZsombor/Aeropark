<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/{user}/documents', [DocumentController::class, 'showUploadedDocuments'])->name('user.documents');
    Route::post('/{user}/documents', [DocumentController::class, 'store'])->name('user.documents.store');
    Route::delete('users/{user}/documents/{document}', [DocumentController::class, 'destroy'])->name('user.documents.destroy');


});


require __DIR__ . '/auth.php';

require __DIR__ . '/admin-auth.php';
