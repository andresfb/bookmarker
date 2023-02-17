<?php

namespace App\Providers;

use App\Extensions\RefreshableStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->booting(function () {
            Cache::extend('refresh', function ($app) {
                return Cache::repository(new RefreshableStore($app));
            });
        });
    }

    public function boot()
    {
    }
}
