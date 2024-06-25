<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
        {{-- <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />--}}
        <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    </head>
    <body x-data="themeSwitcher()" :class="{ 'dark': switchOn }" class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-light-green">

            <!-- Page Content -->
            <main>
                @livewire('navigation-menu')
                @include('layouts.sidebar')
                    <div class="p-4 sm:ml-64">
                        <div class="p-4 brounded-lg dark:border-gray-700 mt-14">
                            <!-- Page Heading -->
                            @if (isset($header))
                                {{ $header }}
                            @endif
                        </div>
                        {{ $slot }}
                    </div>
            </main>

        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
