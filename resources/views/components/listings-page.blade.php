<div>
    <x-slot name="header">
        {{ $header }} @if ($tag !== null) - Tag: {{ ucwords($tag->name) }} @endif
    </x-slot>

@if($showAdd)
    <x-slot name="newBookmark">
        <livewire:add-marker-component :section-id="$section" :tag="$tag->slug ?? ''" />
    </x-slot>
@endif

    <livewire:markers-list-component
        :perPage="$perPage"
        :section="$section"
        :archived="$archived"
        :hidden="$hidden"
        :tag="$tag->slug ?? ''" />

</div>
