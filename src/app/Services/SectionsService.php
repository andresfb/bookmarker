<?php

namespace App\Services;

use App\Models\Section;
use App\Traits\CacheRefreshable;

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
        return Section::select(['id', 'title', 'slug', 'is_default'])
            ->whereUserId($userId)
            ->orderBy('order_by')
            ->cacheFor(
                !$this->refreshCache()
                    ? $this->serviceTtlMinutes(90)
                    : null
            )->cacheTags(["sections:user_id:$userId"])
            ->get()
            ->toArray();
    }
}
