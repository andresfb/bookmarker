<x-app-layout>

    <x-slot name="header">
        {{ __('All Bookmarks') }}
    </x-slot>

@foreach($markers as $marker)

    <!-- TODO move the New Bookmark list to a livewire component -->
    <!-- TODO livewire component should listen to a new url created event -->

    <div class="flex">

        <div class="lg:pl-4 w-full mr-4">


            <a href="{{ $marker['url'] }}" target="_blank" class="text-lg lg:text-2xl font-semibold">
            @if(empty($marker['title']))
                <div class="text-gray-500 italic">{{ substr($marker['url'], 0, 42) }}...</div>
            @else
                {{ $marker['title'] }}
            @endif
            </a>
            <div class="text-xs lg:text-sm mt-3">
                <span class="mr-5 text-gray-500">
                    {{ $marker['created_at']->diffForHumans() }}
                </span>

                <span class="mr-5 text-gray-300">•</span>

            @if(!empty($marker['domain']))
                <a href="{{ $marker['domain'] }}" class="text-gray-500 no-underline mr-5">{{ $marker['domain'] }}</a>
            @endif
            </div>
        </div>

        <div class="flex px-5">
            <button class="text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>
            </button>
        </div>

        <div class="flex justify-items-center lg:pr-4">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
            </button>
        </div>
    </div>

    <div class="my-5 border-gray-200 border-t"></div>
@endforeach

</x-app-layout>
