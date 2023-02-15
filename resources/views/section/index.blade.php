<x-app-layout>

    <x-listings-page
        :header="$sectionTitle"
        :tag="$tag"
        :section="$section"
        :archived="$archived"
        :hidden="$hidden"
        :page="$page"
        :perPage="$perPage"
        :load-markers="true"
        :showAdd="true"
    />

</x-app-layout>
