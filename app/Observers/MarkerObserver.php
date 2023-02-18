<?php

namespace App\Observers;

use Exception;
use App\Models\Marker;
use App\Services\MarkerMutatorService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class MarkerObserver
{
    public function __construct(private readonly MarkerMutatorService $service)
    {
    }

    public function creating(Marker $marker): void
    {
        try {
            $this->service->setDomain($marker);
            $this->service->getTitle($marker);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    public function saved(Marker $marker): void
    {
        Cache::tags("markers:user_id:$marker->user_id")->flush();
    }

    public function deleted(Marker $marker): void
    {
        Cache::tags("markers:user_id:$marker->user_id")->flush();
    }
}
