<?php

namespace App\Services;

use App\Models\Section;
use App\Traits\CacheRefreshable;
use Illuminate\Support\Facades\Cache;

class SectionsService
{
    use CacheRefreshable;

    /**
     * getSimpleList Method.
     *
     * @param int $userId
     * @return array
     */
    public function getSimpleList(int $userId): array
    {
        return Cache::tags("sections:user_id:$userId")->remember(
            md5("sections:user_id:$userId"),
            !$this->refreshCache() ? $this->longLivedTtlMinutes() : null,
            function () use ($userId) {
                return Section::select(['id', 'title', 'slug', 'is_default'])
                    ->whereUserId($userId)
                    ->orderBy('order_by')
                    ->get()
                    ->toArray();
            }
        );
    }
}
