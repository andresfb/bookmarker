<?php

namespace App\Http\Livewire;

use App\Models\Marker;
use App\Models\Tag;
use App\Services\SectionsService;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use LivewireUI\Modal\ModalComponent;

class EditMarkerComponent extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public array $sections;
    public array $tags;

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

        $marker = Marker::with('tags')->findOrFail($markerId);
        Gate::authorize('update', $marker);

        $this->marker = $marker;
        $this->form->fill([
            'tags' => $marker->getTagList()
        ]);

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
     * save Method.
     *
     * @return void
     */
    public function save(): void
    {
        $this->validate();
        $this->marker->save();

        $tags = array_map(static function ($tag) {
            return strtolower(trim($tag));
        }, $this->tags);

        if (!empty($this->tags)) {
            $this->marker->syncTagsWithType($tags, (string) $this->marker->user_id);
        }

        $this->emit('markerSaved');
        $this->closeModal();
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

    /**
     * getFormSchema Method.
     *
     * @return array
     */
    protected function getFormSchema(): array
    {
        return [
            SpatieTagsInput::make('tags')
                ->type((string) $this->marker->user_id)
                ->suggestions(
                    Tag::getUserTags($this->marker->user_id)
                )
        ];
    }
}
