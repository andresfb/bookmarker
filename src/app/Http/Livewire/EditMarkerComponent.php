<?php

namespace App\Http\Livewire;

use App\Models\Marker;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use LivewireUI\Modal\ModalComponent;

class EditMarkerComponent extends ModalComponent
{
    public Marker $marker;

    /**
     * mount Method.
     *
     * @param int $markerId
     * @return void
     */
    public function mount(int $markerId): void
    {
        $marker = Marker::findOrFail($markerId);

        Gate::authorize('update', $marker);

        $this->marker = $marker;
    }

    /**
     * render Method.
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('livewire.edit-marker');
    }

    /**
     * modalMaxWidth Method.
     *
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    /**
     * closeModalOnEscape Method.
     *
     * @return bool
     */
    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    /**
     * closeModalOnClickAway Method.
     *
     * @return bool
     */
    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    /**
     * destroyOnClose Method.
     *
     * @return bool
     */
    public static function destroyOnClose(): bool
    {
        return true;
    }
}
