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
    <body class="antialiased bg-base-100 {{ !app()->isProduction() ? 'debug-screens' : '' }}">

        <div class="drawer drawer-mobile">
            <input id="drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content" style="scroll-behavior: smooth; scroll-padding-top: 5rem;">

                <x-top-panel />

                <div class="px-6 xl:pr-2 pb-16">
                    <div class="flex flex-col-reverse justify-between gap-6 xl:flex-row">
                        <div class="w-full max-w-full flex-grow">

                            <!-- New Bookmark form -->
                        @if(isset($newBookmark))
                            {{ $newBookmark }}
                        @endif

                            <!-- Page Heading -->
                        @if (isset($header))
                            <div class="mt-3 mb-6 text-xl lg:text-2xl font-bold">{{ $header }}</div>
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
