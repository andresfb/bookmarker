<x-app-layout>

    <x-listings-page
        header="Archived"
        :tag="$tag"
        :section="$section"
        :archived="$archived"
        :hidden="$hidden"
        :perPage="$perPage"
        :showAdd="false"
    />

</x-app-layout>
