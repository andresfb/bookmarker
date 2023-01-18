<?php

namespace App\Observers;

use App\Jobs\GetSiteTitleJob;
use App\Models\Marker;
use App\Services\MarkerMutatorService;

class MarkerObserver
{
    public function __construct(private readonly MarkerMutatorService $service)
    {
    }

    public function creating(Marker $marker): void
    {
        $this->service->setDomain($marker);
    }

    public function created(Marker $marker): void
    {
        GetSiteTitleJob::dispatch($marker);
    }
}
