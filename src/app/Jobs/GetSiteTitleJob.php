<?php

namespace App\Jobs;

use App\Models\Marker;
use App\Services\MarkerMutatorService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GetSiteTitleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private MarkerMutatorService $service;

    /**
     * Constructor
     *
     * @param  Marker  $marker
     */
    public function __construct(private readonly Marker $marker)
    {
        $this->service = resolve(MarkerMutatorService::class);
    }

    /**
     * handle Method.
     *
     * @return void
     *
     * @throws Exception
     */
    public function handle(): void
    {
        try {
            $this->service->getTitle($this->marker);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
