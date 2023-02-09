<?php

namespace App\Http\Livewire;

use App\Enums\MarkerStatus;
use App\Models\Marker;
use App\Services\MarkerService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class MarkersListComponent extends Component
{
    public int $perPage = 0;
    public int $section = 0;
    public string $tag = "";
    public bool $hidden = false;
    public bool $archived = false;

    protected $listeners = [
        'markerSaved' => 'render',
    ];

    private MarkerService $service;


    /**
     * boot Method.
     *
     * @param MarkerService $service
     * @return void
     */
    public function boot(MarkerService $service): void
    {
        $this->service = $service;
    }

    /**
     * archive Method.
     *
     * @param int $markerId
     * @return void
     */
    public function archive(int $markerId): void
    {
        $marker = Marker::find($markerId);
        $marker->status = MarkerStatus::ARCHIVED;
        if (!$marker->save()) {
            session()->flash("error", "Can't archive Marker");
            return;
        }

        $this->render();
    }

    /**
     * archive Method.
     *
     * @param int $markerId
     * @return void
     */
    public function hide(int $markerId): void
    {
        $marker = Marker::find($markerId);
        $marker->status = MarkerStatus::HIDDEN;
        if (!$marker->save()) {
            session()->flash("error", "Can't hide Marker");
            return;
        }

        $this->render();
    }

    /**
     * render Method.
     *
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        return view('livewire.markers-list', [
            'markers' => $this->service->userId(auth()->id())
                ->section($this->section)
                ->archived($this->archived)
                ->hidden($this->hidden)
                ->tag($this->tag)
                ->paginated($this->perPage)
                ->get()
        ]);
    }
}
