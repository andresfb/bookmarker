<?php

namespace App\Services;

use App\Models\Marker;
use App\Traits\CacheRefreshable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MarkerService
{
    use CacheRefreshable;

    /**
     * getActiveList Method.
     *
     * @param int $userId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getActiveList(int $userId, int $perPage): LengthAwarePaginator
    {
        return Marker::active()
            ->where('user_id', $userId)
            ->with('tags')
            ->cacheFor(
                !$this->refreshCache()
                    ? $this->serviceTtlMinutes()
                    : null
            )->cacheTags(["active:list:user_id:$userId"])
            ->paginate($perPage);
    }

    /**
     * getSectionedList Method.
     *
     * @param int $userId
     * @param int $sectionId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getSectionedList(int $userId, int $sectionId, int $perPage): LengthAwarePaginator
    {
        return Marker::active()
            ->whereUserId($userId)
            ->whereSectionId($sectionId)
            ->with('tags')
            ->cacheFor(
                !$this->refreshCache()
                    ? $this->serviceTtlMinutes()
                    : null
            )->cacheTags(["sectioned:list:user_id:$userId:section_id:$sectionId"])
            ->paginate($perPage);
    }
}
