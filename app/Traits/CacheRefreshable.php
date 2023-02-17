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
     * longLivedTtlMinutes Method.
     *
     * Defaults to 30 minutes
     *
     * @param int $adjust
     * @return Carbon
     */
    public function longLivedTtlMinutes(int $adjust = 0): Carbon
    {
        return now()->addMinutes(
            (int) config('constants.cache.ttl.long_lived_minutes') + ($adjust)
        );
    }

    /**
     * mediumLivedTtlMinutes Method.
     *
     * Defaults to 15 minutes
     *
     * @param int $adjust
     * @return Carbon
     */
    public function mediumLivedTtlMinutes(int $adjust = 0): Carbon
    {
        return now()->addMinutes(
            (int) config('constants.cache.ttl.medium_lived_minutes') + ($adjust)
        );
    }

    /**
     * shortLivedTllMinutes Method.
     *
     * Defaults to 5 minutes
     *
     * @param int $adjust
     * @return Carbon
     */
    public function shortLivedTtlMinutes(int $adjust = 0): Carbon
    {
        return now()->addMinutes(
            (int) config('constants.cache.ttl.short_lived_minutes') + ($adjust)
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
