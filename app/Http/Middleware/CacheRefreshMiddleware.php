<?php

namespace App\Http\Middleware;

use App\Traits\CacheRefreshable;
use Closure;
use Illuminate\Http\Request;

class CacheRefreshMiddleware
{
    use CacheRefreshable;

    public function handle(Request $request, Closure $next): mixed
    {
        $refresh = $request->has(config('constants.cache.refresh_field'));

        $this->setRefresh($refresh);

        return $next($request);
    }
}
