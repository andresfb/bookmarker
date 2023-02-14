<div>

    <section class="overflow-hidden text-gray-600 body-font">
        <div class="container mx-auto px-3 py-8">
            <div class="-my-8 divide-y-2 divide-gray-100">

                @foreach($markers as $marker)
                    <div class="flex flex-wrap py-6 md:flex-nowrap">

                        <div class="mb-6 md:flex-grow">
                            <h2 class="mb-2 text-xl font-medium text-gray-900 title-font xl:text-2xl">
                                <a href="{{ $marker['url'] }}" target="_blank">
                                    @if(empty($marker['title']))
                                        <div class="italic text-gray-500">{{ substr($marker['url'], 0, 42) }}...</div>
                                    @else
                                        {{ $marker['title'] }}
                                    @endif
                                </a>
                            </h2>

                            <div class="space-x-2 text-gray-500">
                            <span class="leading-relaxed">
                                <a href="{{ route('section', $marker['section']['slug']) }}" class="no-underline">
                                    {{ $marker['section']['title'] }}
                                </a>
                            </span>
                                @if(!empty($marker['domain']))
                                    <span class="text-gray-300 text-sm"><small>•</small></span>
                                    <span class="leading-relaxed">
                                <a href="{{ $marker['domain'] }}" class="no-underline lowercase">{{ $marker['domain'] }}</a>
                            </span>

                                @endif
                            </div>

                            @if($marker['tags']->count())
                                <div class="mt-4 flex flex-row flex-wrap">
                                @foreach($marker['tags'] as $tag)
                                    <a href="?tag={{ $tag['slug'] }}" class="mr-2 lg:mr-4">
                                        <div class="badge badge-accent">
                                            {{ $tag['name'] }}
                                        </div>
                                    </a>
                                @endforeach
                                </div>
                            @endif

                        </div>

                        <div class="flex flex-shrink-0 flex-col md:mb-0 ">
                            <span class="mt-1 text-sm text-gray-500">{{ $marker['created_at']->diffForHumans() }}</span>
                            <div class="mt-6 space-x-3">

                                <!-- Edit -->
                                <button wire:click='$emit("openModal", "edit-marker-component", {{ json_encode(["markerId" => $marker['id']], JSON_THROW_ON_ERROR) }})'
                                        class="text-gray-500 tooltip tooltip-secondary tooltip-left" data-tip="edit" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                        <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z"/>
                                        <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z"/>
                                    </svg>
                                </button>

                                <!-- Archive -->
                                <label for="archiveModal"
                                       wire:click="archive({{ $marker['id'] }})"
                                       data-tip="archive"
                                       class="text-gray-500 tooltip tooltip-secondary hover:cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                         stroke="currentColor"
                                         class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                                    </svg>
                                </label>

                                <!-- Hide -->
                                <label for="hideModal"
                                        wire:click="hide({{ $marker['id'] }})"
                                        data-tip="hide"
                                        class="text-gray-500 tooltip tooltip-secondary tooltip-right hover:cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </label>

                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </section>

@if($markers->count())
    <section>
        <div class="p-4">
            {{ $markers->links() }}
        </div>
    </section>
@endif

    <input type="checkbox" id="archiveModal" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Archive Marker?</h3>
            <div class="modal-action">
                <label for="archiveModal" class="btn btn-sm btn-info">No</label>
                <label for="archiveModal"
                   wire:click="archiveIt"
                   class="btn btn-sm btn-secondary hover:cursor-pointer">Yes</label>
            </div>
        </div>
    </div>

    <input type="checkbox" id="hideModal" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Hide Marker?</h3>
            <p class="py-4">You'll need to enter your password to see this marker.</p>
            <div class="modal-action">
                <label for="hideModal" class="btn btn-sm btn-info">No</label>
                <label for="hideModal"
                       wire:click="hideIt"
                       class="btn btn-sm btn-secondary hover:cursor-pointer">Yes</label>
            </div>
        </div>
    </div>

</div>

@push('modals')
    @livewire('livewire-ui-modal')
@endpush
