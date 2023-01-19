<?php

namespace App\Http\Controllers;

use App\Services\MarkerService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * __invoke Method.
     *
     * @return Application|Factory|View
     */
    public function __invoke(MarkerService $service)
    {
        return view(
            'dashboard',
            ['markers' => $service->getActiveList((int) auth()->id())]
        );
    }
}
