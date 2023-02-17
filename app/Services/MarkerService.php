<?php

namespace App\Services;

use App\Models\Marker;
use App\Traits\CacheRefreshable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use RuntimeException;

class MarkerService
{
    use CacheRefreshable;

    private int $page = 0;
    private int $userId = 0;
    private int $perPage = 0;
    private int $markerId = 0;
    private int $sectionId = 0;
    private string $tagSlug = "";
    private bool $hidden = false;
    private bool $archived = false;
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
     * @param int $page
     * @return MarkerService
     */
    public function page(int $page): MarkerService
    {
        $this->page = $page;
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
     * @param int $markerId
     * @return MarkerService
     */
    public function markerId(int $markerId): MarkerService
    {
        $this->markerId = $markerId;
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
        $this->filterMarker();

        $cacheKey = sprintf(
            "marker(s):%s:%s:%s:%s:%s:%s:%s:%s",
            $this->userId,
            $this->sectionId,
            $this->page,
            $this->perPage,
            $this->tagSlug,
            $this->hidden,
            $this->archived,
            $this->markerId,
        );

        return Cache::tags("markers:user_id:$this->userId")->remember(
            md5($cacheKey),
            $this->longLivedTtlMinutes(),
            function () {
                return $this->markers->paginate($this->perPage);
            }
        );
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
     * filterMarker Method.
     *
     * @return void
     */
    private function filterMarker(): void
    {
        if (empty($this->markerId)) {
            return;
        }

        $this->markers->where('id', $this->markerId);
    }
}
