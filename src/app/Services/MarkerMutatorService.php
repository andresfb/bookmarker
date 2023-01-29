<?php

namespace App\Services;

use App\Models\Marker;
use App\Traits\Domainable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MarkerMutatorService
{
    use Domainable;

    public function setDomain(Marker $marker): void
    {
        $marker->domain = $this->getDomain($marker->url);
    }

    /**
     * getTitle Method.
     *
     * @param  Marker  $marker
     * @return void
     */
    public function getTitle(Marker $marker): void
    {
        if (empty($marker->url)) {
            return;
        }

        $response = Http::get($marker->url);

        if ($response->failed()) {
            Log::error(sprintf(
                $marker->url,
                "Can't get title for: %s. Server error: %s | Client error: %s",
                $response->serverError(),
                $response->clientError())
            );

            return;
        }

        if (!preg_match('/<title>(.+)<\/title>/', $response->body(), $matches) || ! isset($matches[1])) {
            return;
        }

        $marker->title = ucwords(strtolower(trim($matches[1])));
        $marker->save();
    }
}
