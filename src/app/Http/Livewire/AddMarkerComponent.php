<?php

namespace App\Http\Livewire;

use App\Enums\MarkerStatus;
use App\Models\Marker;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AddMarkerComponent extends Component
{
    public int $sectionId = 0;
    public string $url = "";
    public string $tag = "";

    protected array $rules = [
        'url' => 'required|string|url|unique:markers,url'
    ];

    /**
     * add Method.
     *
     * @return void
     */
    public function add(): void
    {
        if (!auth()->check()) {
            return;
        }

        $values = $this->validate();

        $userId = auth()->id();
        if (!$this->sectionId) {
            $this->sectionId = Section::getDefault($userId)->id;
        }

        $marker = Marker::create([
            'user_id' => $userId,
            'section_id' => $this->sectionId,
            'status' => MarkerStatus::ACTIVE,
            'url' => $values['url'],
        ]);

        if ($marker === null) {
            session()->flash("error", "Can't add URL");
            return;
        }

        if (!empty($this->tag)) {
            $marker->syncTagsWithType([$this->tag], $userId);
        }

        $this->reset();
        $this->emit('markerSaved');
    }

    /**
     * render Method.
     *
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        return view('livewire.add-marker');
    }
}
