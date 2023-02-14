<?php

namespace App\Services;

use App\Models\Marker;
use App\Traits\CacheRefreshable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use RuntimeException;

class MarkerService
{
    use CacheRefreshable;

    private int $userId = 0;
    private int $sectionId = 0;
    private int $perPage = 0;
    private string $tagSlug = "";
    private string $cacheKey = "";
    private bool $hidden = false;
    private bool $archived = false;
    private bool $formatted = false;
    private ?Builder $markers;


    /**
     * paginated Method.
     *
     * @param int $perPage
     * @return MarkerService
     */
    public function paginated(int $perPage): MarkerService
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * format Method.
     *
     * @return MarkerService
     */
    public function format(): MarkerService
    {
        $this->formatted = true;
        return $this;
    }

    /**
     * userId Method.
     *
     * @param int $userId
     * @return $this
     */
    public function userId(int $userId): MarkerService
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * section Method.
     *
     * @param int $section
     * @return $this
     */
    public function section(int $section): MarkerService
    {
        $this->sectionId = $section;
        return $this;
    }

    /**
     * archived Method.
     *
     * @param bool $archived
     * @return $this
     */
    public function archived(bool $archived): MarkerService
    {
        $this->archived = $archived;
        return $this;
    }

    /**
     * @param bool $hidden
     * @return MarkerService
     */
    public function hidden(bool $hidden): MarkerService
    {
        $this->hidden = $hidden;
        return $this;
    }

    /**
     * tag Method.
     *
     * @param string $tagSlug
     * @return $this
     */
    public function tag(string $tagSlug): MarkerService
    {
        $this->tagSlug = $tagSlug;
        return $this;
    }

    /**
     * get Method.
     *
     * @return Collection|LengthAwarePaginator
     */
    public function get(): Collection|LengthAwarePaginator
    {
        if (empty($this->userId)) {
            throw new RuntimeException("Missing User Id");
        }

        $this->loadBaseQuery();
        $this->setArchived();
        $this->setHidden();
        $this->setActive();
        $this->filterSection();
        $this->filterTags();
        $this->setCache();
        $markers = $this->paginate();

        if ($this->formatted) {
            return $this->formatted($markers);
        }

        return $markers;
    }


    /**
     * loadBaseQuery Method.
     *
     * @return void
     */
    private function loadBaseQuery(): void
    {
        $this->markers = Marker::whereUserId($this->userId)
            ->withInfo();
    }

    /**
     * setArchived Method.
     *
     * @return void
     */
    private function setArchived(): void
    {
        if (!$this->archived) {
            return;
        }

        $this->markers->archived();
    }

    /**
     * setHidden Method.
     *
     * @return void
     */
    private function setHidden(): void
    {
        if (!$this->hidden) {
            return;
        }

        $this->markers->hidden($this->userId);
    }

    /**
     * setActive Method.
     *
     * @return void
     */
    private function setActive(): void
    {
        if ($this->hidden || $this->archived) {
            return;
        }

        $this->markers->active();
    }

    /**
     * filterSection Method.
     *
     * @return void
     */
    private function filterSection(): void
    {
        if (empty($this->sectionId)) {
            return;
        }

        $this->markers->where('section_id', $this->sectionId);
    }

    /**
     * filterTags Method.
     *
     * @return void
     */
    private function filterTags(): void
    {
        if (empty($this->tagSlug)) {
            return;
        }

        $this->markers->withAnyTags([$this->tagSlug], $this->userId);
    }

    /**
     * cacheQuery Method.
     *
     * @return void
     */
    private function setCache(): void
    {
        $this->markers->cacheFor(
            !$this->refreshCache() ? $this->serviceTtlMinutes() : null
        );
    }

    /**
     * paginate Method.
     *
     * @return Collection|LengthAwarePaginator|array
     */
    private function paginate(): Collection|LengthAwarePaginator
    {
        if ($this->perPage > 0) {
            return $this->markers->paginate($this->perPage);
        }

        return $this->markers->get();
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
