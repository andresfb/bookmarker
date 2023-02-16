<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MarkerController extends Controller
{
    /**
     * __invoke Method.
     *
     * @param Marker $marker
     * @return Application|Factory|View
     */
    public function __invoke(Marker $marker)
    {
        return view('markers.view')
            ->with($marker->section->getBaseInfo())
            ->with([
                'marker'  => $marker->id,
                'section' => $marker->section_id,
            ]);
    }
}
