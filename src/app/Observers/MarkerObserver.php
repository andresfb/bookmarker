<?php

namespace App\Observers;

use Exception;
use App\Models\Marker;
use App\Services\MarkerMutatorService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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
        try {
            $this->service->setDomain($marker);
            $this->service->getTitle($marker);
        } catch (Exception $e) {
            Log::error($e);
        }
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
