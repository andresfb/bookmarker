<?php

namespace App\Http\Controllers;

use App\Models\Section;
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
    public function index(Request $request)
    {
        $perPage = $this->getPerPageValue($request, 'dashboard.index');

        $section = Section::getDefault(auth()->id());

        return view('dashboard.index')
            ->with($section->getBaseInfo())
            ->with('perPage', $perPage)
            ->with('section', 0);
    }

    /**
     * view Method.
     *
     * @param Request $request
     * @param Section $section
     * @return Application|Factory|View
     */
    public function view(Request $request, Section $section)
    {
        $perPage = $this->getPerPageValue($request, 'dashboard.view');

        return view('dashboard.view')
            ->with($section->getBaseInfo())
            ->with('perPage', $perPage)
            ->with('section', $section->id);
    }
}
