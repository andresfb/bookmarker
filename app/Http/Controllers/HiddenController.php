<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Traits\TagRequestable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HiddenController extends Controller
{
    use TagRequestable;

    /**
     * index Method.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $userId = auth()->id();
        $key = sprintf(config('constants.marker_hidden_key'), $userId);
        $cachedUserId = (int) Cache::get($key, 0);
        if ($cachedUserId !== $userId) {
            return view('hidden.access');
        }

        [$tag, $page, $perPage, $section] = $this->getBaseValues($request, $userId, 'hidden');

        return view('hidden.index')
            ->with($section->getBaseInfo())
            ->with([
                'section' => 0,
                'archived'=> false,
                'hidden'  => true,
                'tag'     => $tag,
                'perPage' => $perPage,
                'page'    => $page,
            ]);
    }

    /**
     * save Method.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password:web']
        ]);

        $userId = auth()->id();
        $key = sprintf(config('constants.marker_hidden_key'),$userId);
        Cache::put($key, $userId, now()->addHour());
        return redirect()->route('hidden');
    }

    /**
     * destroy Method.
     *
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        $userId = auth()->id();
        $key = sprintf(config('constants.marker_hidden_key'),$userId);
        Cache::delete($key);
        return redirect()->route('dashboard');
    }
}
