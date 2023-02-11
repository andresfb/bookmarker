<x-app-layout>

    <div class="py-3">
        <form action="{{ route('hidden.reset') }}" method="post">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-error">Reset Access</button>
        </form>
    </div>

    <x-listings-page
        header="Hidden Bookmarks"
        :tag="$tag"
        :section="$section"
        :archived="$archived"
        :hidden="$hidden"
        :perPage="$perPage"
        :showAdd="false"
    />

</x-app-layout>
