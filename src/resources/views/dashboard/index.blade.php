<x-app-layout>

    <x-slot name="header">
        {{ __('All Bookmarks') }}
    </x-slot>

    <x-slot name="newBookmark">
        <livewire:add-marker-component :section-id="$section" />
    </x-slot>

    <livewire:markers-list-component :perPage="$perPage" :section="$section" />

</x-app-layout>
