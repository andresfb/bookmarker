<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="bumblebee">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="antialiased bg-base-100">
{{--        <x-jet-banner />--}}

        <div class="drawer drawer-mobile">
            <input id="drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content" style="scroll-behavior: smooth; scroll-padding-top: 5rem;">

                <x-top-panel />

                <div class="px-6 xl:pr-2 pb-16">
                    <div class="flex flex-col-reverse justify-between gap-6 xl:flex-row">
                        <div class="prose w-full max-w-full flex-grow">

                            <!-- New Bookmark form -->
                            <!-- TODO move the New Bookmark to a livewire component -->

                            <div class="py-3">
                                <form action="" method="post" class="flex">
                                    @csrf

                                    <div class="text-gray-300 mt-3 mr-1 text-sm hidden md:flex">
                                        <svg fill="currentColor" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                        </svg>
                                    </div>

                                    <!-- border-transparent focus:border-transparent focus:ring-0 -->
                                    <input type="url" name="url" class="w-full mr-3 input focus:outline-none focus:ring-primary focus:border-primary" placeholder="Enter URL..." required>
                                    <button type="submit" class="mt-2 mr-1 lg:mr-4 btn btn-sm btn-primary">add</button>
                                </form>
                            </div>

                        <!-- Page Heading -->
                        @if (isset($header))
                            <div class="mt-3 text-xl lg:text-2xl font-bold">{{ $header }}</div>
                        @endif

                            <div class="my-3 md:my-4 border-gray-200 border-t"></div>

                            <!-- Page content here -->
                            <main>
                                {{ $slot }}
                            </main>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Side Panel -->
            <x-side-panel :sections="$sections" />

        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
