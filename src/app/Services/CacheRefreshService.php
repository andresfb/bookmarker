<?php

namespace App\Services;

class CacheRefreshService
{
    private bool $refresh = false;

    /**
     * @return bool
     */
    public function isRefresh(): bool
    {
        if (config('constants.cache.skip')) {
            return true;
        }

        return $this->refresh;
    }

    /**
     * @param  bool  $refresh
     */
    public function setRefresh(bool $refresh): void
    {
        $this->refresh = $refresh;
    }
}
