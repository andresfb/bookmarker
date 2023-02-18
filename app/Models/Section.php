<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Section extends Model
{
    use Sluggable, SoftDeletes;

    /** @var string[] */
    protected $guarded = [];

    /** @var array<string, string>  */
    protected $casts = [
        'is_default'=> 'boolean',
        'order_by'  => 'integer',
        'deleted_at'=> 'datetime',
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];

    protected static function booted(): void
    {
        static::saved(static function (Section $section) {
            Cache::tags("sections:user_id:$section->user_id")->flush();
        });
    }


    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'title'],
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function markers(): HasMany
    {
        return $this->hasMany(Marker::class);
    }

    public function getBaseInfo(): array
    {
        $sectionTitle = $this->title;
        $sectionSlug = $this->slug;

        return compact('sectionTitle', 'sectionSlug');
    }

    public static function getDefault(int $userId): Section
    {
        return self::whereUserId($userId)
            ->whereIsDefault(true)
            ->first();
    }

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
