<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Traits\TagRequestable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * index Method.
     *
     * @return Application|Factory|View
     */
    public function __invoke(Request $request)
    {
        [$tag, $page, $perPage, $section] = $this->getBaseValues($request, auth()->id(), 'dashboard');

        return view('dashboard.index')
            ->with($section->getBaseInfo())
            ->with([
                'section' => 0,
                'archived'=> false,
                'hidden'  => false,
                'tag'     => $tag,
                'page'    => $page,
                'perPage' => $perPage,
            ]);
    }
}
