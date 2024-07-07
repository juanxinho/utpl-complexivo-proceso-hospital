<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Doctor Appointments') }}
        </h1>
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
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td class="border px-4 py-2">{{ $loop->index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $appointment->service_date }}</td>
                            <td class="border px-4 py-2">{{ $appointment->usuarioRol->usuario->first_name }} {{ $appointment->usuarioRol->usuario->last_name }}</td>
                            <td class="border px-4 py-2">{{ $appointment->status }}</td>
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

