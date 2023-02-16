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
    public int $markerId = 0;
    public int $processMarkerId = 0;
    public int $page = 0;
    public int $perPage = 0;
    public int $section = 0;
    public string $tag = "";
    public bool $hidden = false;
    public bool $archived = false;
    public bool $loadMarkers = true;

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
        $this->processMarkerId = $markerId;
    }

    /**
     * archiveId Method.
     *
     * @return void
     */
    public function archiveIt(): void
    {
        if (empty($this->processMarkerId)) {
            return;
        }

        $marker = Marker::find($this->processMarkerId);
        $marker->status = MarkerStatus::ARCHIVED;
        if (!$marker->save()) {
            session()->flash("error", "Can't archive Marker");
            return;
        }

        $this->processMarkerId = 0;
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
        $this->processMarkerId = $markerId;
    }

    /**
     * hideId Method.
     *
     * @return void
     */
    public function hideIt(): void
    {
        if (empty($this->processMarkerId)) {
            return;
        }

        $marker = Marker::find($this->processMarkerId);
        $marker->status = MarkerStatus::HIDDEN;
        if (!$marker->save()) {
            session()->flash("error", "Can't hide Marker");
            return;
        }

        $this->processMarkerId = 0;
        $this->render();
    }

    /**
     * render Method.
     *
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        $markers = !$this->loadMarkers
            ? collect()
            : $this->service->userId(auth()->id())
                ->archived($this->archived)
                ->hidden($this->hidden)
                ->markerId($this->markerId)
                ->section($this->section)
                ->tag($this->tag)
                ->paginated($this->perPage)
                ->page($this->page)
                ->get();

        return view('livewire.markers-list', ['markers' => $markers]);
    }
}
