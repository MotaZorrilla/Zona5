<?php

namespace App\Providers;

use App\Services\DebugService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registrar el servicio de depuración
        $this->app->singleton('debug.service', function ($app) {
            return new DebugService(config('app.debug', false));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

}
