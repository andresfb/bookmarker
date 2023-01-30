<?php

namespace App\Observers;

use App\Jobs\GetSiteTitleJob;
use App\Models\Marker;
use App\Services\MarkerMutatorService;
use Illuminate\Support\Facades\Cache;

class MarkerObserver
{
    /**
     * Constructor
     *
     * @param MarkerMutatorService $service
     */
    public function __construct(private readonly MarkerMutatorService $service)
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
        $key = sprintf(config('constants.cache.refresh_key'), $marker->user_id);
        Cache::put($key, 1, now()->addMinute());
    }
}
