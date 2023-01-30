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

    protected $listeners = [
        'urlAdded' => 'render',
        'echo:markers,MarkerTitleUpdatedEvent' => 'listening',
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

    public function listening(): void
    {
        Log::info('I heard you');
        $this->render();
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
     * render Method.
     *
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        return view('livewire.markers-list', [
            'markers' => $this->service->load(auth()->id(), $this->section)
                ->paginated($this->perPage)
                ->get()
        ]);
    }
}
