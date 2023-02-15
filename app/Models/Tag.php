<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class Tag extends \Spatie\Tags\Tag
{
    /**
     * booted Method.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::saved(static function (Tag $tag) {
            Cache::tags("markers:user_id:" . (int) $tag->type)->flush();
        });
    }


    /**
     * getUserTags Method.
     *
     * @param int $userId
     * @return array
     *
     */
    public static function getUserTags(int $userId): array
    {
        return self::query()
            ->select('name')
            ->where('type', $userId)
            ->orderBy('name')
            ->get()
            ->pluck('name')
            ->toArray();
    }
}
