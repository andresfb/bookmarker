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
    use TagRequestable;

    /**
     * index Method.
     *
     * @return Application|Factory|View
     */
    public function __invoke(Request $request)
    {
        $tag = $this->getTagFromRequest($request);
        $perPage = $this->getPerPageValue($request, 'dashboard');
        $section = Section::getDefault(auth()->id());

        return view('dashboard.index')
            ->with($section->getBaseInfo())
            ->with([
                'section' => 0,
                'archived'=> false,
                'hidden'  => false,
                'tag'     => $tag,
                'perPage' => $perPage,
            ]);
    }
}
