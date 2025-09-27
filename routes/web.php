<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContentManagerController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Public\LodgeController as PublicLodgeController;
use App\Http\Controllers\Public\AboutUsController;
use App\Http\Controllers\Public\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

// Logout route - required for the application
Route::post('logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::name('public.')->group(function () {
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');
    Route::view('/lodges', 'public.lodges')->name('lodges');
    Route::get('logias/{lodge}', [PublicLodgeController::class, 'show'])->name('lodges.show');
    Route::get('/forums', [App\Http\Controllers\Public\ForumController::class, 'index'])->name('forums');
    Route::get('/forums/{forum}', [App\Http\Controllers\Public\ForumController::class, 'show'])->name('forums.show');
    Route::post('/forums/{forum}/posts', [App\Http\Controllers\Public\ForumController::class, 'storePost'])->name('forums.store-post');
    Route::post('/forums/posts/{post}/vote', [App\Http\Controllers\Public\ForumController::class, 'vote'])->name('forums.vote');
    Route::get('/school', [App\Http\Controllers\Public\SchoolController::class, 'index'])->name('school');
    Route::get('/archive', [App\Http\Controllers\Public\ArchiveController::class, 'index'])->name('archive');
    Route::get('/news', [App\Http\Controllers\Public\NewsController::class, 'index'])->name('news');
    Route::get('/contact', [App\Http\Controllers\Public\ContactController::class, 'show'])->name('contact');
    Route::post('/contact', [App\Http\Controllers\Public\ContactController::class, 'store'])->name('contact.store');
    Route::view('/sitemap', 'public.sitemap')->name('sitemap');
    Route::view('/faq', 'public.faq')->name('faq');
});

Route::view('/privacy-policy', 'public.privacy-policy')->name('privacy-policy');
Route::view('/terms-of-service', 'public.terms-of-service')->name('terms-of-service');

// Área de administración
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // SuperAdmin and Admin access
    Route::middleware(['role:SuperAdmin,Admin'])->group(function () {
        Route::resource('lodges', App\Http\Controllers\Admin\LodgeController::class);
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::resource('zone-dignitaries', App\Http\Controllers\Admin\ZoneDignitaryController::class);
        Route::resource('news', App\Http\Controllers\Admin\NewsController::class)->except(['show']);
        Route::resource('forums', App\Http\Controllers\Admin\ForumController::class)->except(['show']);
        Route::resource('school', App\Http\Controllers\Admin\SchoolController::class)->except(['show']);
        Route::resource('treasury', App\Http\Controllers\Admin\TreasuryController::class);
        Route::resource('repository', App\Http\Controllers\Admin\RepositoryController::class);
        Route::get('repository/{repository}/download', [App\Http\Controllers\Admin\RepositoryController::class, 'download'])->name('repository.download');
        Route::resource('events', App\Http\Controllers\Admin\EventController::class);
        Route::resource('faqs', App\Http\Controllers\Admin\FaqController::class);
        Route::patch('faqs/{faq}/toggle', [App\Http\Controllers\Admin\FaqController::class, 'toggle'])->name('faqs.toggle');
        Route::resource('forums', App\Http\Controllers\Admin\ForumController::class);
        Route::patch('forums/{forum}/toggle', [App\Http\Controllers\Admin\ForumController::class, 'toggle'])->name('forums.toggle');
        Route::get('settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings');
        Route::post('settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
        Route::get('content-manager/{section?}', [ContentManagerController::class, 'show'])->name('content-manager.show');
        Route::post('content-manager/contact', [ContentManagerController::class, 'updateContact'])->name('content-manager.contact.update');
        
        // Rutas de reportes
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::post('reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
        Route::post('reports/get-task-status', [ReportController::class, 'getTaskStatus'])->name('reports.get-task-status');
        Route::post('reports/start-processing', [ReportController::class, 'startProcessing'])->name('reports.start-processing');
        Route::get('reports/download/{filename}', [ReportController::class, 'download'])->name('reports.download');
        Route::get('reports/task-logs', [ReportController::class, 'getTaskLogs'])->name('reports.task-logs');
        Route::delete('reports/delete/{filename}', [ReportController::class, 'delete'])->name('reports.delete');
        
        // Rutas de seguimiento de progreso en tiempo real
        Route::prefix('progress-tracker')->name('progress-tracker.')->group(function () {
            Route::post('get-progress', [App\Http\Controllers\Admin\ProgressTrackerController::class, 'getProgress'])->name('get-progress');
            Route::post('get-detailed-logs', [App\Http\Controllers\Admin\ProgressTrackerController::class, 'getDetailedLogs'])->name('get-detailed-logs');
            Route::post('export-data', [App\Http\Controllers\Admin\ProgressTrackerController::class, 'exportProgressData'])->name('export-data');
            Route::get('stats', [App\Http\Controllers\Admin\ProgressTrackerController::class, 'getTrackerStats'])->name('stats');
        });
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