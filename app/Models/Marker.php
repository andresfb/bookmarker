<?php

namespace App\Models;

use App\Enums\MarkerStatus;
use App\Traits\Domainable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\Tags\HasTags;

/**
 * Class Marker
 *
 * Being observed on App\Observers\MarkerObserver
 */
class Marker extends Model
{
    use HasTags, Sluggable, SoftDeletes;
    use Searchable, Domainable;

    /** @var string[] */
    protected $guarded = [];

    /** @var string[] */
    protected $casts = [
        'id'        => 'integer',
        'user_id'   => 'integer',
        'section_id'=> 'integer',
        'priority'  => 'integer',
        'deleted_at'=> 'datetime',
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
        'status'    => MarkerStatus::class,
    ];


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
     * section Method.
     *
     * @return BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * scopeActive Method.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', MarkerStatus::ACTIVE)
            ->orderBy('priority')
            ->latest();
    }

    /**
     * scoreArchived Method.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeArchived(Builder $query): Builder
    {
        return $query->where('status', MarkerStatus::ARCHIVED)
            ->orderBy('priority')
            ->latest();
    }

    /**
     * scopeHidden Method.
     *
     * @param Builder $query
     * @param int $userId
     * @return Builder
     */
    public function scopeHidden(Builder $query, int $userId): Builder
    {
        $key = sprintf(config('constants.marker_hidden_key'), $userId);
        $cachedUserId = (int) Cache::get($key, 0);
        if ($cachedUserId !== $userId) {
            return $query->where('status', Str::random(50));
        }

        return $query->where('status', MarkerStatus::HIDDEN);
    }

    /**
     * scopeWithInfo Method.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithInfo(Builder $query): Builder
    {
        return $query->with('tags')
            ->with('section');
    }

    /**
     * getTagNamesList Method.
     *
     * @return array
     */
    public function getTagList(): array
    {
        if (empty($this->tags)) {
            return [];
        }

        return $this->tags->pluck('name')->toArray();
    }

    /**
     * getTagClassName Method.
     *
     * @return string
     */
    public static function getTagClassName(): string
    {
        return Tag::class;
    }

    /**
     * validationRules Method.
     *
     * @return string[]
     */
    public static function validationRules(string $modelName = ""): array
    {
        $rules = [
            'section_id' => ['required', 'integer', 'exists:sections,id'],
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'notes' => ['nullable', 'string'],
        ];

        if (empty($modelName)) {
            return $rules;
        }

        $data = [];
        foreach ($rules as $key => $rule) {
            $data["$modelName.$key"] = $rule;
        }

        return $data;
    }

    /**
     * searchable Method.
     *
     * @return bool
     */
    public function searchable(): bool
    {
        return $this->status === MarkerStatus::ACTIVE;
    }

    /**
     * searchableAs Method.
     *
     * @return string
     */
    public function searchableAs(): string
    {
        return 'bookmarker_markers_index';
    }

    /**
     * toSearchableArray Method.
     *
     * @return array|null
     */
    public function toSearchableArray(): array|null
    {
        $this->tags;

        return [
            'id'        => $this->id,
            'user_id'   => $this->user_id,
            'url'       => $this->url,
            'title'     => $this->title,
            'domain'    => $this->domain,
            'slug'      => $this->slug,
            'notes'     => $this->notes,
            'section'   => $this->section->title,
            'tags'      => trim($this->tags?->pluck('name')->implode(', ')),
            'created_at'=> $this->created_at,
        ];
    }
}
