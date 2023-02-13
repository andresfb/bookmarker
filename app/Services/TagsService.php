<?php

namespace App\Services;

use App\Models\Tag;

class TagsService
{
    /**
     * getUserList Method.
     *
     * @param int $userId
     * @return array
     */
    public function getUserList(int $userId): array
    {
        return Tag::whereType($userId)
            ->orderBy('name')
            ->get()
            ->map(function (Tag $tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'slug' => $tag->slug,
                ];
            })
            ->toArray();
    }
}
