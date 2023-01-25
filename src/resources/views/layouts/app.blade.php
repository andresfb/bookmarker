<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="bumblebee">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap&text=daisyUIThemostpopular,freeandopen-sourceTailwindCSScomponentlibrary" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-base-100">
        <x-jet-banner />

        <div class="drawer drawer-mobile">
            <input id="drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content" style="scroll-behavior: smooth; scroll-padding-top: 5rem;">

                <x-top-panel />

                <div class="px-6 xl:pr-2 pb-16">
                    <div class="flex flex-col-reverse justify-between gap-6 xl:flex-row">
                        <div class="prose w-full max-w-4xl flex-grow">

                        <!-- Page Heading -->
                        @if (isset($header))
                            <h2 class="mt-2">{{ $header }}</h2>
                        @endif

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
