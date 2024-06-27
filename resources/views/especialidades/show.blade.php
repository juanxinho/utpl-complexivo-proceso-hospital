<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Especialidad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <x-label value="{{ __('Nombre') }}" />
                    <p>{{ $especialidad->nombre }}</p>
                </div>

                <div class="mb-4">
                    <x-label value="{{ __('Abreviatura') }}" />
                    <p>{{ $especialidad->abreviatura }}</p>
                </div>

                <div class="mb-4">
                    <x-label value="{{ __('Descripción') }}" />
                    <p>{{ $especialidad->descripcion }}</p>
                </div>

                <div class="mb-4">
                    <x-label value="{{ __('Estado') }}" />
                    <p>{{ $especialidad->estado ? 'Activo' : 'Inactivo' }}</p>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('especialidades.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Volver') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
