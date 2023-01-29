<?php

namespace App\Services;

use App\Enums\MarkerCachekeys;
use App\Models\Marker;
use App\Models\Section;
use Illuminate\Support\Facades\Cache;

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

    /**
     * refreshMarkers Method.
     *
     * @param int $userId
     * @return void
     */
    public function refreshMarkers(int $userId): void
    {
        $keys[] = MarkerCachekeys::active($userId);

        $sections = Section::select('id')
            ->whereUserId($userId)
            ->get();

        foreach ($sections as $section) {
            $keys[] = MarkerCachekeys::sectioned($userId, $section->id);
        }

        foreach ($keys as $key) {
            Cache::delete($key);
        }

        Marker::flushQueryCache($keys);
    }
}
