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
        if (empty($htmlString)) {
            throw new RuntimeException("Can't get site data for $marker->url");
        }

        $htmlDom = new DOMDocument();
        if (!$htmlDom->loadHTML($htmlString)) {
            throw new RuntimeException("Can't load HTML for $marker->url");
        }

        $title = $htmlDom->getElementsByTagName('title');
        if (!$title->count()) {
            throw new RuntimeException("No Title tags found on $marker->url");
        }

        $marker->title = ucwords(strtolower(trim($title->item(0)->nodeValue)));
        $marker->save();
    }
}
