<?php

namespace App\Http\Livewire;

use App\Models\Marker;
use App\Services\SectionsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use LivewireUI\Modal\ModalComponent;

class EditMarkerComponent extends ModalComponent
{
    public array $sections;
    public Marker $marker;

    /**
     * mount Method.
     *
     * @param int $markerId
     * @return void
     */
    public function mount(int $markerId): void
    {
        $sectionsService = resolve(SectionsService::class);

        $marker = Marker::findOrFail($markerId);
        Gate::authorize('update', $marker);

        $this->marker = $marker;
        $this->sections = $sectionsService->getSimpleList(auth()->id());
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
        return '2xl';
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

//    /**
//     * closeModalOnClickAway Method.
//     *
//     * @return bool
//     */
//    public static function closeModalOnClickAway(): bool
//    {
//        return false;
//    }

    /**
     * destroyOnClose Method.
     *
     * @return bool
     */
    public static function destroyOnClose(): bool
    {
        return true;
    }


    /**
     * rules Method.
     *
     * @return array
     */
    protected function rules(): array
    {
        return Marker::validationRules('marker');
    }
}
