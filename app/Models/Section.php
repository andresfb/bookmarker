<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Section extends BookModel
{
    use Sluggable;

    /** @var string[] */
    protected $casts = [
        'is_default' => 'boolean',
        'order_by' => 'integer',
    ];

    /**
     * booted Method.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::saved(static function (Section $section) {
            Cache::tags("sections:user_id:$section->user_id")->flush();
        });
    }


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
     * @param int $userId
     * @return Section
     */
    public static function getDefault(int $userId): Section
    {
        return self::whereUserId($userId)
            ->whereIsDefault(true)
            ->first();
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
                'Programming',
                'Writing',
                'Photography',
                'Research',
            ],
        ];
    }
}
