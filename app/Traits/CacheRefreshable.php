<?php

namespace App\Traits;

use App\Services\CacheRefreshService;
use Illuminate\Support\Carbon;

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
     * serviceTtlMinutes Method.
     *
     * @param int $adjust
     * @return Carbon
     */
    public function serviceTtlMinutes(int $adjust = 0): Carbon
    {
        return now()->addMinutes(
            (int) config('constants.cache.ttl.service_minutes') + ($adjust)
        );
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
