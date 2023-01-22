<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends BookModel
{
    use Sluggable;

    /**
     * sluggable Method.
     *
     * @return array[]
     */
    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'title'],
        ];
    }

    /**
     * user Method.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * getDefault Method.
     *
     * @return Model|null
     */
    public static function getDefault(): ?Model
    {
        return self::whereIsDefault(true)->first();
    }

    /**
     * getStandardList Method.
     *
     * @return array
     */
    public static function getStandardList(): array
    {
        return [
            'General',
            [
                'General',
                'For Work',
                'Movies',
                'Writing',
                'Photography',
                'Research',
            ],
        ];
    }
}
