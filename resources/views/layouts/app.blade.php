<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

</head>
<body x-data="themeSwitcher()" :class="{ 'dark': switchOn }" class="font-sans antialiased">
<div class="fixed top-0 z-50 w-full">
    <x-banner/>
    @livewire('navigation-menu')

</div>

<div class="min-h-screen bg-malachite-50 dark:bg-gray-950">

    <!-- Page Content -->
    <main>
        @include('sidebars.sidebar')
        <div class="p-4 sm:ml-64">
            <div class="px-0 mt-14 md:p-2">
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
