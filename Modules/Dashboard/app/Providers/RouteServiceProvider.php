<?php

namespace Modules\Dashboard\App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Dashboard\App\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace . '\Api')
            ->group(module_path('Dashboard', '/routes/api.php'));

        Route::middleware('web',)
            ->namespace($this->moduleNamespace)
            
            ->group(module_path('Dashboard', '/routes/web.php'));

        Route::middleware('web', 'auth:admin',)
            ->namespace($this->moduleNamespace . '\Dashboard')
              ->prefix( 'dashboard')
            ->as('dashboard.')
            ->group(module_path('Dashboard', '/routes/dashboard.php'));
    }
}
