<?php

namespace App\Traits;

use App\Models\Tag;
use Illuminate\Http\Request;

trait TagRequestable
{
    /**
     * getTagFromRequest Method.
     *
     * @param string $tag
     * @return mixed
     */
    private function getTag(string $tag): mixed
    {
        if (empty($tag)) {
            return null;
        }

        return Tag::findFromString($tag, auth()->id());
    }
}
