<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Traits\TagRequestable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs;
    use ValidatesRequests, TagRequestable;

    /**
     * getBaseValues Method.
     *
     * @param Request $request
     * @param int|null $userId
     * @param string $route
     * @return array
     */
    protected function getBaseValues(Request $request, ?int $userId, string $route): array
    {
        $values = $request->validate([
            'tag' => ['nullable', 'string'],
            'page'=> ['nullable', 'integer']
        ]);

        $tag = $this->getTag($values['tag'] ?? '');
        $perPage = $this->getPerPageValue($request, $route);
        $section = $userId ? Section::getDefault($userId) : null;

        return [$tag, $values['page'] ?? 0, $perPage, $section];
    }

    /**
     * getPerPageValue Method.
     *
     * @param Request $request
     * @param string $route
     * @param string $page
     * @return int
     */
    protected function getPerPageValue(Request $request, string $route, string $page = 'default'): int
    {
        $key = $route . '_per_page';
        $cookieValue = Session::get($key, Cookie::get($key));
        $perPage = (int) $request->get($key, $cookieValue);

        $options = config("constants.pagination.$page.per_page_options");
        if (!$perPage || !in_array($perPage, $options, true)) {
            $perPage = (int) config("constants.pagination.$page.per_page_default");
        }

        Cookie::make($key, (string) $perPage, 5);
        Session::put($key, $perPage);
        return $perPage;
    }
}
