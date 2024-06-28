<!-- resources/views/especialidades/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Specialties') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900 dark:text-gray-500 p-6">
                @if (session('success'))
                    <div class="mb-4 text-malachite-600 dark:text-malachite-300">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('especialidades.create') }}" class="mb-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Create New Specialty') }}
                </a>

                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Abbreviation') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($especialidades as $especialidad)
                        <tr>
                            <td class="border px-4 py-2">{{ $especialidad->idespecialidad }}</td>
                            <td class="border px-4 py-2">{{ __($especialidad->nombre) }}</td>
                            <td class="border px-4 py-2">{{ $especialidad->abreviatura }}</td>
                            <td class="border px-4 py-2">{{ __($especialidad->descripcion) }}</td>
                            <td class="border px-4 py-2">{{ $especialidad->estado ? __('Activo') : __('Inactivo') }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('especialidades.show', $especialidad->idespecialidad) }}" class="bg-malachite-500 hover:bg-malachite-700 text-white font-bold py-2 px-4 rounded">{{ __('Ver') }}</a>
                                <a href="{{ route('especialidades.edit', $especialidad->idespecialidad) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">{{ __('Editar') }}</a>
                                <form action="{{ route('especialidades.destroy', $especialidad->idespecialidad) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('{{ __('¿Está seguro de que desea eliminar esta especialidad?') }}')">
                                        {{ __('Eliminar') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
