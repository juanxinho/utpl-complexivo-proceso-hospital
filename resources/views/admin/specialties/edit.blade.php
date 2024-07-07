<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Editar Especialidad') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900 dark:text-gray-500 p-6">
                <form action="{{ route('specialties.update', $specialty->id_specialty) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-label for="name" value="{{ __('Nombre') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $specialty->name }}" required autofocus />
                        <x-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="abbreviation" value="{{ __('Abbreviation') }}" />
                        <x-input id="abbreviation" class="block mt-1 w-full" type="text" name="abbreviation" value="{{ $specialty->abbreviation }}" />
                        <x-input-error for="abbreviation" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="description" value="{{ __('Description') }}" />
                        <x-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ $specialty->description }}" />
                        <x-input-error for="description" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="status" value="{{ __('Status') }}" />
                        <select id="status" name="status" class="block mt-1 w-full">
                            <option value="1" {{ $specialty->status ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ !$specialty->status ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        <x-input-error for="status" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Actualizar Especialidad') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
