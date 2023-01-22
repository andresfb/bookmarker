<?php

namespace App\Observers;

use App\Jobs\GetSiteTitleJob;
use App\Models\Marker;
use App\Models\Section;
use App\Services\MarkerMutatorService;

class MarkerObserver
{
    /**
     * Constructor
     *
     * @param  MarkerMutatorService  $service
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
        if (empty($marker->section_id)) {
            $marker->section_id = Section::getDefault()->id ?? 1;
        }

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
}
