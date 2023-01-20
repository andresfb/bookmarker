<?php

namespace App\Traits;

use App\Services\CacheRefreshService;

trait CacheRefreshable
{
    /**
     * setRefresh Method.
     *
     * @param  bool  $value
     * @return void
     */
    public function setRefresh(bool $value): void
    {
        $service = resolve(CacheRefreshService::class);
        $service->setRefresh($value);
    }

    /**
     * getRefresh Method.
     *
     * @return bool
     */
    public function refreshCache(): bool
    {
        return resolve(CacheRefreshService::class)->isRefresh();
    }

    /**
     * refreshStatic Method.
     *
     * @return bool
     */
    public static function refreshStatic(): bool
    {
        return resolve(CacheRefreshService::class)->isRefresh();
    }
}
