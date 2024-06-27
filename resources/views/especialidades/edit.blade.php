<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Especialidad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('especialidades.update', $especialidad->idespecialidad) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-label for="nombre" value="{{ __('Nombre') }}" />
                        <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" value="{{ $especialidad->nombre }}" required autofocus />
                        <x-input-error for="nombre" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="abreviatura" value="{{ __('Abreviatura') }}" />
                        <x-input id="abreviatura" class="block mt-1 w-full" type="text" name="abreviatura" value="{{ $especialidad->abreviatura }}" />
                        <x-input-error for="abreviatura" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="descripcion" value="{{ __('Descripción') }}" />
                        <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" value="{{ $especialidad->descripcion }}" />
                        <x-input-error for="descripcion" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="estado" value="{{ __('Estado') }}" />
                        <select id="estado" name="estado" class="block mt-1 w-full">
                            <option value="1" {{ $especialidad->estado ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ !$especialidad->estado ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        <x-input-error for="estado" class="mt-2" />
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
