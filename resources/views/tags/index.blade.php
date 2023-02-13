<x-app-layout>

    <div class="mt-3 mb-6 text-xl lg:text-2xl font-bold">Tags</div>

    @dump($tags)

    <x-listings-page
        :tag="$tag"
        :section="$section"
        :archived="$archived"
        :hidden="$hidden"
        :perPage="$perPage"
        :load-markers="$loadMarkers"
        :showAdd="false" />

</x-app-layout>
