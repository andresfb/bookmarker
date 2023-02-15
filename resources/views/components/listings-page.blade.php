<div>

@if (isset($header))
    <x-slot name="header">
        {{ $header }} @if ($tag !== null) - Tag: {{ ucwords($tag->name) }} @endif
    </x-slot>
@endif

@if($showAdd)
    <x-slot name="newBookmark">
        <livewire:add-marker-component :section-id="$section" :tag="$tag->slug ?? ''" />
    </x-slot>
@endif

    <livewire:markers-list-component
        :page="$page"
        :perPage="$perPage"
        :section="$section"
        :archived="$archived"
        :hidden="$hidden"
        :load-markers="$loadMarkers"
        :tag="$tag->slug ?? ''" />

</div>
