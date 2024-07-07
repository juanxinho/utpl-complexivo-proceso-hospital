<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Specialty details') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900 dark:text-gray-500 p-6">
                <div class="mb-4">
                    <x-label value="{{ __('Name') }}" />
                    <p>{{ $specialty->name }}</p>
                </div>

                <div class="mb-4">
                    <x-label value="{{ __('Abbreviation') }}" />
                    <p>{{ $specialty->abbreviation }}</p>
                </div>

                <div class="mb-4">
                    <x-label value="{{ __('Description') }}" />
                    <p>{{ $specialty->description }}</p>
                </div>

                <div class="mb-4">
                    <x-label value="{{ __('Status') }}" />
                    <p>{{ $specialty->status ? 'Active' : 'Inactive' }}</p>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('specialties.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
