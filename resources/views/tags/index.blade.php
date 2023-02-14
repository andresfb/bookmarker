<x-app-layout>

    <div class="mt-6 text-xl lg:text-2xl font-bold">
        Tags
    @if($loadMarkers)
        <a href="{{ route('tags') }}" class="ml-2 text-primary-focus tooltip tooltip-secondary" data-tip="reload">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>
        </a>
    </div>
@endif

@if(!empty($tags))

    <section class="mb-10">
        <div class="container-fluid px-2 py-3 mx-auto">
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-6 2xl:grid-cols-8 gap-5">

            @foreach($tags as $item)
                <div class="p-2">
                    <a href="{{ route('tags', ['tag' => $item['slug']]) }}">
                        <div class="text-lg text-amber-600 border-2 text-center rounded-lg border-amber-500">
                            {{ $item['name'] }}
                        </div>
                    </a>
                </div>
            @endforeach

            </div>
        </div>
    </section>

@endif

    <x-listings-page
        :tag="$tag"
        :section="$section"
        :archived="$archived"
        :hidden="$hidden"
        :perPage="$perPage"
        :load-markers="$loadMarkers"
        :showAdd="false" />

</x-app-layout>
