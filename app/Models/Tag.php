<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Laravel\Scout\Searchable;

class Tag extends \Spatie\Tags\Tag
{
    use Searchable;

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

    /**
     * searchableAs Method.
     *
     * @return string
     */
    public function searchableAs(): string
    {
        return 'bookmarker_tags_index';
    }

    /**
     * toSearchableArray Method.
     *
     * @return array|null
     */
    public function toSearchableArray(): array|null
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'slug'      => $this->slug,
            'user_id'   => (int) $this->type,
            'created_at'=> $this->created_at,
        ];
    }
}
