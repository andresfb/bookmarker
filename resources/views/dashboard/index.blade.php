<x-app-layout>

    <x-listings-page
        header="All Bookmarks"
        :tag="$tag"
        :section="$section"
        :archived="$archived"
        :hidden="$hidden"
        :perPage="$perPage"
        :showAdd="true"
    />

</x-app-layout>
