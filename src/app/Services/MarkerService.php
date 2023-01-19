<?php

namespace App\Services;

use App\Models\Marker;
use App\Traits\CacheRefreshable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class MarkerService
{
    use CacheRefreshable;

    /**
     * getActiveList Method.
     *
     * @param int $userId
     * @return Collection
     */
    public function getActiveList(int $userId): Collection
    {
        $key = md5(sprintf(config('constants.makers_active_list'), $userId));
        $markers = Cache::get($key);
        if (!empty($markers) && !$this->refreshCache()) {
            return $markers;
        }

        $markers = Marker::active()
            ->where('user_id', $userId)
            ->with('tags')
            ->get();

        if (!$markers->count()) {
            return $markers;
        }

        Cache::put($key, $markers, now()->addHour());
        return $markers;
    }
}
