<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Detalle de Especialidad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900 dark:text-gray-500 p-6">
                <div class="mb-4">
                    <x-label value="{{ __('Nombre') }}" />
                    <p>{{ $specialty->nombre }}</p>
                </div>

                <div class="mb-4">
                    <x-label value="{{ __('Abreviatura') }}" />
                    <p>{{ $specialty->abreviatura }}</p>
                </div>

                <div class="mb-4">
                    <x-label value="{{ __('Descripción') }}" />
                    <p>{{ $specialty->descripcion }}</p>
                </div>

                <div class="mb-4">
                    <x-label value="{{ __('Estado') }}" />
                    <p>{{ $specialty->estado ? 'Activo' : 'Inactivo' }}</p>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('specialties.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Volver') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
