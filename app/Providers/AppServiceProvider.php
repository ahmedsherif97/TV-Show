<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\TVShow\App\Models\TvShow;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(ModuleServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Paginator::useBootstrap();
        Blade::directive('admin', function () {
            return '<?php if (auth()->check() && auth()->user()->can("access dashboard")): ?>';
        });

        Blade::directive('endadmin', function ($expression) {
            return '<?php endif; ?>';
        });

        View::composer('*', function ($view) {
            $randomTvShows = TvShow::where('is_active', true)
                ->inRandomOrder()
                ->limit(5)
                ->get();

            $view->with('randomTvShows', $randomTvShows);
        });
    }
}
