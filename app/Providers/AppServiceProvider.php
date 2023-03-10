<?php

namespace App\Providers;

use App\Services\CacheRefreshService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(CacheRefreshService::class, function () {
            return new CacheRefreshService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if (!app()->runningInConsole()) {
            Model::preventLazyLoading(!app()->isProduction());
        }
    }
}
