<?php

namespace App\Services;

use App\Events\MarkerTitleUpdatedEvent;
use App\Models\Marker;
use App\Traits\Domainable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MarkerMutatorService
{
    use Domainable;

    /**
     * setDomain Method.
     *
     * @param Marker $marker
     * @return void
     */
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

        $title = ucwords(strtolower(trim(strip_tags($matches[1]))));
        if (strlen($title) >= 100) {
            $title = substr($title, 0, 100) . "...";
        }

        $marker->title = $title;
        $marker->save();

        event(new MarkerTitleUpdatedEvent);
    }
}
