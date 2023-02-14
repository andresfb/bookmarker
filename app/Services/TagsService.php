<?php

namespace App\Services;

use App\Enums\MarkerStatus;
use App\Models\Marker;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\JoinClause;

class TagsService
{
    /**
     * getTag Method.
     *
     * @param int $tagId
     * @return array
     */
    public function getTag(int $tagId): array
    {
        return $this->formatted(
            $this->getBaseQuery()
                ->where('tags.id', $tagId)
                ->get()
        );
    }

    /**
     * getUserList Method.
     *
     * @param int $userId
     * @param string $tagId
     * @return array
     */
    public function getUserList(int $userId): array
    {
        return $this->formatted(
            $this->getBaseQuery()
                ->where('tags.type', $userId)
                ->get()
        );
    }

    /**
     * getBaseQuery Method.
     *
     * @return Builder
     */
    private function getBaseQuery(): Builder
    {
        return Tag::query()
            ->select('tags.*')
            ->join('taggables', 'tags.id', '=', 'taggables.tag_id')
            ->join('markers', function (JoinClause $join) {
                return $join->on('markers.id', '=', 'taggables.taggable_id')
                    ->where('taggables.taggable_type', Marker::class);
            })
            ->where('markers.status', MarkerStatus::ACTIVE);
    }

    /**
     * formatted Method.
     *
     * @param Collection $tags
     * @return array
     */
    private function formatted(Collection $tags): array
    {
        return $tags->map(function (Tag $tag) {
            return [
                'id' => $tag->id,
                'name' => $tag->name,
                'slug' => $tag->slug,
            ];
        })
        ->sortBy('name')
        ->toArray();
    }
}
