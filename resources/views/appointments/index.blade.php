<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('My Appointments') }}
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

                <a href="{{ route('appointments.create') }}" class="mb-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Create New Appointment') }}
                </a>

                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Date and Time</th>
                        <th>Doctor</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td class="border px-4 py-2">{{ $loop->index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $appointment->fecha_atencion }}</td>
                            <td class="border px-4 py-2">{{ $appointment->medicoHorario->usuarioRol->usuario->nombres }}</td>
                            <td class="border px-4 py-2">{{ $appointment->estado }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('appointments.show', $appointment->idappointment) }}" class="bg-malachite-500 hover:bg-malachite-700 text-white font-bold py-2 px-4 rounded">View</a>
                                <a href="{{ route('appointments.edit', $appointment->idappointment) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                <form action="{{ route('appointments.destroy', $appointment->idappointment) }}" method="POST" class="inline">
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

