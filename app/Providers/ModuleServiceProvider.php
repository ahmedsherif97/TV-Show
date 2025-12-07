<?php

namespace App\Providers;

use App\Services\ModuleService;
use App\Services\SettingService;
use Illuminate\Support\ServiceProvider;
use Modules\Setting\App\Models\Setting;

class ModuleServiceProvider extends ServiceProvider
{

    // Sort "Other Providers.." line to add new modules after it

    protected $providers = [
        // Other Providers goes here
        "Modules\Episode\App\Providers\AppServiceProvider",
        "Modules\TVShow\App\Providers\AppServiceProvider",

        "Modules\Notification\App\Providers\AppServiceProvider",
        "Modules\Media\App\Providers\AppServiceProvider",
        "Modules\Auth\App\Providers\AppServiceProvider",
        "Modules\User\App\Providers\AppServiceProvider",
        "Modules\Dashboard\App\Providers\AppServiceProvider",
        "Modules\Role\App\Providers\AppServiceProvider",
        "Modules\Permission\App\Providers\AppServiceProvider",
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $modules = [];
        $providers = array_reverse($this->providers);
        foreach ($this->providers as $provider) {
            try {
                $modules[] = explode('\\', $provider)[1];
                $this->app->register($provider);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        $this->app->bind('modules', function ($app) use ($modules) {
            return new ModuleService(array_reverse($modules));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
