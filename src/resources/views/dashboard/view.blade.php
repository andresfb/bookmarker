<x-app-layout>
    <x-slot name="header">
        {{ $sectionTitle }}
    </x-slot>

    <livewire:markers-list-component :markers="$markers" :perPage="$perPage" />

</x-app-layout>
