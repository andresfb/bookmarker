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
    public string $url = "";

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
        $marker = Marker::create([
            'user_id' => $userId,
            'section_id' => Section::getDefault($userId)->id,
            'status' => MarkerStatus::ACTIVE,
            'url' => $values['url'],
        ]);

        if ($marker === null) {
            session()->flash("error", "Can't add URL");
            return;
        }

        $this->reset();
        $this->emit('urlAdded');
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
