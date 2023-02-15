<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Traits\TagRequestable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ArchivedController extends Controller
{
    use TagRequestable;

    /**
     * __invoke Method.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function __invoke(Request $request)
    {
        [$tag, $page, $perPage, $section] = $this->getBaseValues($request, auth()->id(), 'archived');

        return view('archived.index')
            ->with($section->getBaseInfo())
            ->with([
                'section' => 0,
                'archived'=> true,
                'hidden'  => false,
                'tag'     => $tag,
                'perPage' => $perPage,
                'page'    => $page,
            ]);
    }
}
