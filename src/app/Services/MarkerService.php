<?php

namespace App\Services;

use App\Enums\MarkerCachekeys;
use App\Models\Marker;
use App\Traits\CacheRefreshable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use RuntimeException;

class MarkerService
{
    use CacheRefreshable;

    private int $perPage = 0;
    private bool $formatted = false;
    private ?Builder $markers;


    /**
     * load Method.
     *
     * @param int $userId
     * @param int $section
     * @return $this
     */
    public function load(int $userId, int $section = 0): static
    {
        // TODO: change the service to allow setting the userid and section via functions.
        // TODO: add a new function to allow filtering by tag

        if ($section === 0) {
            return $this->loadActive($userId);
        }

        return $this->loadSectioned($userId, $section);
    }

    /**
     * loadActive Method.
     *
     * @param int $userId
     * @return $this
     */
    public function loadActive(int $userId): static
    {
        $this->markers = Marker::active()
            ->where('user_id', $userId)
            ->withInfo()
            ->cacheFor(
                !$this->refreshCache()
                    ? $this->serviceTtlMinutes()
                    : null
            )->cacheTags([MarkerCachekeys::active($userId)]);

        return $this;
    }

    /**
     * loadSectioned Method.
     *
     * @param int $userId
     * @param int $sectionId
     * @return $this
     */
    public function loadSectioned(int $userId, int $sectionId): static
    {
        $this->markers = Marker::active()
            ->whereUserId($userId)
            ->whereSectionId($sectionId)
            ->withInfo()
            ->cacheFor(
                !$this->refreshCache()
                    ? $this->serviceTtlMinutes()
                    : null
            )->cacheTags([MarkerCachekeys::sectioned($userId, $sectionId)]);

        return $this;
    }

    /**
     * paginated Method.
     *
     * @param int $perPage
     * @return $this
     */
    public function paginated(int $perPage): static
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * format Method.
     *
     * @return $this
     */
    public function format(): static
    {
        $this->formatted = true;
        return $this;
    }

    /**
     * get Method.
     *
     * @return Collection|LengthAwarePaginator
     */
    public function get(): Collection|LengthAwarePaginator
    {
        // TODO: throw an exception of the's no userid

        if ($this->markers === null) {
            throw new RuntimeException("No Markers loaded");
        }

        if ($this->perPage > 0) {
            $markers = $this->markers->paginate($this->perPage);
        } else {
            $markers = $this->markers->get();
        }

        if ($this->formatted) {
            return $this->formatted($markers);
        }

        return $markers;
    }


    /**
     * formatted Method.
     *
     * @param Collection|LengthAwarePaginator $markers
     * @return Collection
     */
    private function formatted(Collection|LengthAwarePaginator $markers): Collection
    {
        return $markers->map(function (Marker $marker) {
            $data = $marker->toArray();
            $data['section'] = $marker->section->title;
            $data['section_slug'] = $marker->section->slug;
            $data['created'] = $marker->created_at->diffForHumans();

            return $data;
        });
    }
}
