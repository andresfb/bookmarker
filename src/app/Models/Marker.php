<?php

namespace App\Models;

use App\Enums\MarkerStatus;
use App\Traits\Domainable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use phpDocumentor\Reflection\Types\This;
use Spatie\Tags\HasTags;

class Marker extends BookModel
{
    use HasTags;
    use Sluggable, Domainable;

    /** @var string[] */
    protected $casts = [
        'priority' => 'integer',
        'status' => MarkerStatus::class,
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
     * scopeHidden Method.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeHidden(Builder $query): Builder
    {
        if (!cache()->has(config('constants.marker_hidden_key'))) {
            return $query;
        }

        return $query->where('status', MarkerStatus::HIDDEN)
            ->orderBy('priority');
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
}
