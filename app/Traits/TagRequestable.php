<?php

namespace App\Traits;

use App\Models\Tag;
use Illuminate\Http\Request;

trait TagRequestable
{
    /**
     * getTagFromRequest Method.
     *
     * @param Request $request
     * @return mixed
     */
    private function getTagFromRequest(Request $request): mixed
    {
        $value = $request->validate([
            'tag' => ['nullable', 'string']
        ]);

        if (empty($value['tag'])) {
            return null;
        }

        return Tag::findFromString($value['tag'], auth()->id());
    }
}
