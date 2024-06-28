<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Doctor Appointments') }}
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

                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Date and Time</th>
                        <th>Patient</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($citas as $cita)
                        <tr>
                            <td class="border px-4 py-2">{{ $loop->index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $cita->fecha_atencion }}</td>
                            <td class="border px-4 py-2">{{ $cita->usuarioRol->usuario->nombres }} {{ $cita->usuarioRol->usuario->apellidos }}</td>
                            <td class="border px-4 py-2">{{ $cita->estado }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('citas.show', $cita->idcita) }}" class="bg-malachite-500 hover:bg-malachite-700 text-white font-bold py-2 px-4 rounded">View</a>
                                <a href="{{ route('citas.edit', $cita->idcita) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                <form action="{{ route('citas.destroy', $cita->idcita) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
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

