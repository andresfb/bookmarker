<?php

namespace App\Services;

use App\Models\Marker;
use App\Traits\Domainable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MarkerMutatorService
{
    use Domainable, WithFaker;

    public function __construct()
    {
        $this->setUpFaker();
    }

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

        $fallBackSlug = Str::slug($this->faker->words($this->faker->numberBetween(4, 8), true));
        $response = Http::get($marker->url);

        if ($response->failed()) {
            Log::error(sprintf(
                $marker->url,
                "Can't get title for: %s. Server error: %s | Client error: %s",
                $response->serverError(),
                $response->clientError())
            );

            $marker->slug = $fallBackSlug;
            return;
        }

        if (!preg_match('/<title(>|\s.*>)(.+)<\/title>/', $response->body(), $matches) || !isset($matches[1])) {
            $marker->slug = $fallBackSlug;
            return;
        }

        $match = $matches[3] ?? $matches[2] ?? $matches[1];
        $title = trim(strip_tags($match));
        if (strlen($title) >= 100) {
            $title = substr($title, 0, 100) . "...";
        }

        $marker->title = $title;
    }
}
