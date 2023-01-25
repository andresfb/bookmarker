<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * markers Method.
     *
     * @return HasMany
     */
    public function markers(): HasMany
    {
        return $this->hasMany(Marker::class);
    }

    /**
     * getBaseInfo Method.
     *
     * @return array
     */
    public function getBaseInfo(): array
    {
        $sectionTitle = $this->title;
        $sectionSlug = $this->slug;

        return compact('sectionTitle', 'sectionSlug');
    }

    /**
     * getDefault Method.
     *
     * @return Section
     */
    public static function getDefault(): Section
    {
        return self::whereIsDefault(true)->firstOrFail();
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
