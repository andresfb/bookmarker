<?php

namespace App\Models;

use App\Enums\MarkerStatus;
use App\Observers\MarkerObserver;
use App\Traits\Domainable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;

class Marker extends Model
{
    use HasTags;
    use SoftDeletes, Sluggable, Domainable;

    /** @var string[] */
    protected $guarded = [];

    /** @var string[] */
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /** @var string[] */
    protected $casts = [
        'status' => MarkerStatus::class,
        'priority' => 'integer',
    ];


    /**
     * sluggable Method.
     *
     * @return array[]
     */
    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'title']
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
     * scopeActive Method.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', MarkerStatus::ACTIVE->value)
            ->orderBy('priority');
    }

    /**
     * scopeHidden Method.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeHidden(Builder $query): Builder
    {
        if (!cache()->has(config('constants.marker_hidden_key'))) {
            return $query;
        }

        return $query->where('status', MarkerStatus::HIDDEN->value)
            ->orderBy('priority');
    }
}
