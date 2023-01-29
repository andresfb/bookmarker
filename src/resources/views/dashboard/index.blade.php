<x-app-layout>

    <x-slot name="header">
        {{ __('All Bookmarks') }}
    </x-slot>

    <livewire:markers-list-component :perPage="$perPage" :section="$section" />

</x-app-layout>
