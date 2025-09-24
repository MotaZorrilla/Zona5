<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContentManagerController;
use App\Http\Controllers\Public\LodgeController as PublicLodgeController;
use App\Http\Controllers\Public\AboutUsController;
use App\Http\Controllers\Public\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

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
    Route::get('/contact', [App\Http\Controllers\Public\ContactController::class, 'show'])->name('contact');
    Route::post('/contact', [App\Http\Controllers\Public\ContactController::class, 'store'])->name('contact.store');
    Route::view('/sitemap', 'public.sitemap')->name('sitemap');
    Route::view('/faq', 'public.faq')->name('faq');
});

Route::view('/privacy-policy', 'public.privacy-policy')->name('privacy-policy');
Route::view('/terms-of-service', 'public.terms-of-service')->name('terms-of-service');

// Área de administración
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // SuperAdmin and Admin access
    Route::middleware(['role:SuperAdmin,Admin'])->group(function () {
        Route::resource('lodges', App\Http\Controllers\Admin\LodgeController::class);
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::resource('zone-dignitaries', App\Http\Controllers\Admin\ZoneDignitaryController::class);
        Route::resource('news', App\Http\Controllers\Admin\NewsController::class)->except(['show']);
        Route::resource('forums', App\Http\Controllers\Admin\ForumController::class)->except(['show']);
        Route::resource('school', App\Http\Controllers\Admin\SchoolController::class)->except(['show']);
        Route::view('treasury', 'admin.treasury.index')->name('treasury');
        Route::resource('repository', App\\Http\\Controllers\\Admin\\RepositoryController::class);
        Route::view('events', 'admin.events')->name('events');
        Route::view('settings', 'admin.settings')->name('settings');
        Route::get('content-manager/{section?}', [ContentManagerController::class, 'show'])->name('content-manager.show');
    });
    
    // User, Admin and SuperAdmin access (all logged-in users)
    Route::resource('messages', App\Http\Controllers\Admin\MessageController::class);
    Route::post('messages/{message}/archive', [App\Http\Controllers\Admin\MessageController::class, 'archive'])->name('messages.archive');
    Route::post('messages/{message}/unread', [App\Http\Controllers\Admin\MessageController::class, 'unread'])->name('messages.unread');
    Route::get('messages/archived', [App\Http\Controllers\Admin\MessageController::class, 'archived'])->name('messages.archived');
    Route::get('messages/deleted', [App\Http\Controllers\Admin\MessageController::class, 'deleted'])->name('messages.deleted');
    Route::post('messages/{message}/restore', [App\Http\Controllers\Admin\MessageController::class, 'restore'])->name('messages.restore');
    
    Route::view('help', 'admin.help')->name('help');
});

// Ruta principal del dashboard (redirige al dashboard de administración)
Route::get('dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas temporales para previsualización
Route::view('/admin-preview', 'admin-preview')->name('admin-preview');
Route::view('/public-preview', 'public-preview')->name('public-preview');
