<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Traits\TagRequestable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    use TagRequestable;

    /**
     * __invoke Method.
     *
     * @param Request $request
     * @param Section $section
     * @return Application|Factory|View
     */
    public function __invoke(Request $request, Section $section)
    {
        [$tag, $page, $perPage, ] = $this->getBaseValues($request, userId: null, route: 'section');

        return view('section.index')
            ->with($section->getBaseInfo())
            ->with([
                'section' => $section->id,
                'archived'=> false,
                'hidden'  => false,
                'tag'     => $tag,
                'perPage' => $perPage,
                'page'    => $page,
            ]);
    }
}
