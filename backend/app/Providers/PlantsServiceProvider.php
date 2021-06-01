<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PlantsService;
class PlantsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Services\PlantsService', function ($app) {
            return new PlantsService();
        });
    }
}
