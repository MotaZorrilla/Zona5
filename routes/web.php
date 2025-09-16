<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContentManagerController;
use App\Http\Controllers\Public\LodgeController as PublicLodgeController;
use App\Http\Controllers\Public\AboutUsController;

Route::view('/', 'welcome')->name('welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::post('logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::name('public.')->group(function () {


Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');
    Route::view('/lodges', 'public.lodges')->name('lodges');
    Route::get('logias/{lodge}', [PublicLodgeController::class, 'show'])->name('lodges.show');
    Route::view('/forums', 'public.forums')->name('forums');
    Route::view('/school', 'public.school')->name('school');
    Route::view('/archive', 'public.archive')->name('archive');
    Route::view('/news', 'public.news')->name('news');
    Route::view('/contact', 'public.contact')->name('contact');
    Route::view('/sitemap', 'public.sitemap')->name('sitemap');
    Route::view('/faq', 'public.faq')->name('faq');
});

Route::view('/privacy-policy', 'public.privacy-policy')->name('privacy-policy');
Route::view('/terms-of-service', 'public.terms-of-service')->name('terms-of-service');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('lodges', App\Http\Controllers\Admin\LodgeController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('zone-dignitaries', App\Http\Controllers\Admin\ZoneDignitaryController::class);
    Route::view('messages', 'admin.messages')->name('messages');
    Route::resource('school', App\Http\Controllers\Admin\SchoolController::class)->except(['show']);
    Route::view('treasury', 'admin.treasury.index')->name('treasury');
    Route::resource('forums', App\Http\Controllers\Admin\ForumController::class)->except(['show']);
    Route::view('repository', 'admin.repository')->name('repository');
    Route::view('events', 'admin.events')->name('events');
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class)->except(['show']);
    Route::view('settings', 'admin.settings')->name('settings');
    Route::view('help', 'admin.help')->name('help');
    Route::get('content-manager/{section?}', [ContentManagerController::class, 'show'])->name('content-manager.show');
});

// Ruta temporal para la previsualización de la plantilla de administración
Route::view('/admin-preview', 'admin-preview')->name('admin-preview');

// Ruta temporal para la previsualización del sitio público
Route::view('/public-preview', 'public-preview')->name('public-preview');
