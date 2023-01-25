<x-app-layout>
    <x-slot name="header">
        {{ $sectionTitle }}
    </x-slot>

    <x-markers-list :markers="$markers" />

</x-app-layout>
