<?php

namespace App\Http\Middleware;

use App\Traits\CacheRefreshable;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheRefreshMiddleware
{
    use CacheRefreshable;

    public function handle(Request $request, Closure $next): mixed
    {
        $key = sprintf(config('constants.cache.refresh_key'), auth()->id());
        $refresh = (bool) Cache::get($key, $request->has(config('constants.cache.refresh_field')));

        $this->setRefresh($refresh);

        return $next($request);
    }
}
