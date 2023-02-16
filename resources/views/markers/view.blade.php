<x-app-layout>

    <x-slot name="header">
        Marker
    </x-slot>

    <x-slot name="newBookmark">
        <livewire:add-marker-component :section-id="$section" tag="" />
    </x-slot>

    <livewire:markers-list-component
        :marker-id="$marker"
        :section="$section"

    />

</x-app-layout>
