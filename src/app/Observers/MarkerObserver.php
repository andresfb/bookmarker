<?php

namespace App\Observers;

use App\Jobs\GetSiteTitleJob;
use App\Models\Marker;
use App\Models\Section;
use App\Services\CacheRefreshService;
use App\Services\MarkerMutatorService;

class MarkerObserver
{
    /**
     * Constructor
     *
     * @param MarkerMutatorService $service
     * @param CacheRefreshService $cacheService
     */
    public function __construct(
        private readonly MarkerMutatorService $service,
        private readonly CacheRefreshService  $cacheService
    )
    {
    }

    /**
     * creating Method.
     *
     * @param  Marker  $marker
     * @return void
     */
    public function creating(Marker $marker): void
    {
        $this->service->setDomain($marker);
    }

    /**
     * created Method.
     *
     * @param  Marker  $marker
     * @return void
     */
    public function created(Marker $marker): void
    {
        GetSiteTitleJob::dispatch($marker);
    }

    /**
     * saved Method.
     *
     * @param Marker $marker
     * @return void
     */
    public function saved(Marker $marker): void
    {
        $this->cacheService->refreshMarkers($marker->user_id);
    }
}
