<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('API Tokens') }}
        </h1>
    </x-slot>

    <div>
        <div class="mx-auto sm:px-6 lg:px-2">
            @livewire('api.api-token-manager')
        </div>
    </div>
</x-app-layout>
