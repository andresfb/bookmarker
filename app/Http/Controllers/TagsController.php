<?php

namespace App\Http\Controllers;

use App\Services\TagsService;
use App\Traits\TagRequestable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    use TagRequestable;

    /**
     * __invoke Method.
     *
     * @param Request $request
     * @param TagsService $service
     * @return Application|Factory|View
     */
    public function __invoke(Request $request, TagsService $service)
    {
        $tag = $this->getTagFromRequest($request);
        $perPage = $this->getPerPageValue($request, 'tags');

        return view('tags.index')
            ->with([
                'section' => 0,
                'archived'=> false,
                'hidden'  => false,
                'tag'     => $tag,
                'perPage' => $perPage,
                'tags'    => $service->getUserList(auth()->id()),
                'loadMarkers' => false,
            ]);
    }
}
