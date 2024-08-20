<?php

namespace App\Providers;

use App\Services\Managers\CourierServiceManager;
use App\Services\NovaPoshtaService;
use Illuminate\Support\ServiceProvider;

class CourierServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->singleton(CourierServiceManager::class, function ($app) {
            $manager = new CourierServiceManager();
            $manager->registerCourierService('novaposhta', new NovaPoshtaService());
            //here can be added other services
            return $manager;
        });
    }
}
