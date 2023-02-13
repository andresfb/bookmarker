<x-app-layout>

    <x-listings-page
        header="Archived"
        :tag="$tag"
        :section="$section"
        :archived="$archived"
        :hidden="$hidden"
        :perPage="$perPage"
        :load-markers="true"
        :showAdd="false"
    />

</x-app-layout>
