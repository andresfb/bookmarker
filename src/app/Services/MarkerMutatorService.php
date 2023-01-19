<?php

namespace App\Services;

use App\Models\Marker;
use App\Traits\Domainable;
use DOMDocument;
use RuntimeException;

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
     * @param Marker $marker
     * @return void
     */
    public function getTitle(Marker $marker): void
    {
        if (empty($marker->url)) {
            return;
        }

        $htmlString = file_get_contents($marker->url);

        if (!preg_match('/<title>(.+)<\/title>/', $htmlString, $matches) || !isset($matches[1])) {
            return;
        }

        $marker->title = ucwords(strtolower(trim($matches[1])));
        $marker->save();
    }
}
