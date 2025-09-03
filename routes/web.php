<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:SuperAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('lodges', App\Http\Controllers\Admin\LodgeController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});

// Ruta temporal para la previsualización de la plantilla de administración
Route::view('/admin-preview', 'admin-preview')->name('admin-preview');

// Ruta temporal para la previsualización del sitio público
Route::view('/public-preview', 'public-preview')->name('public-preview');
