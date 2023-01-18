<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marker extends Model
{
    use SoftDeletes, Sluggable;

    /** @var string[] */
    protected $guarded = ['id'];

    /** @var string[] */
    protected $dispatchesEvents = [
        'created' => '',
    ];

    /** @var string[] */
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
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
}
