<?php

namespace App\Http\Controllers;

use App\Services\SectionsService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /**
     * getPerPageValue Method.
     *
     * @param Request $request
     * @param string $section
     * @param string $page
     * @return int
     */
    protected function getPerPageValue(Request $request, string $section, string $page = 'default'): int
    {
        $key = $section . '_per_page';
        $cookieValue = Session::get($key, Cookie::get($key));
        $perPage = (int) $request->get($key, $cookieValue);

        $options = config("constants.pagination.$page.per_page_options");
        if (!$perPage || !in_array($perPage, $options, true)) {
            $perPage = (int) config("constants.pagination.$page.per_page_default");
        }

        Cookie::make($key, $perPage, 5);
        Session::put($key, $perPage);
        return $perPage;
    }
}
