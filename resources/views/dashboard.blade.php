<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2 md:py-12">
        <div class="mx-auto sm:px-6 lg:px-2">
            @role('patient')
                @include('welcome.patient')
            @elserole('medic')
                @include('welcome.medic')
            @else
                @include('welcome.welcome')
            @endrole
        </div>
    </div>

</x-app-layout>
