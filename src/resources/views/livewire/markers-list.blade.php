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
                                <a href="{{ route('dashboard.view', $marker['section']['slug']) }}" class="no-underline">
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
                        <div class="mt-4 flex flex-row flex-wrap gap-4">
                        @foreach($marker['tags'] as $tag)
                            <a href="#">
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
                            <button class="text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                    <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                    <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                </svg>
                            </button>

                            <!-- Archive -->
                            <button wire:click="archive({{ $marker['id'] }})" class="text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                            </button>

                        </div>
                    </div>

                </div>
            @endforeach

            </div>
        </div>
    </section>


    <section>
        <div class="p-4">
            {{ $markers->links() }}
        </div>
    </section>

</div>
