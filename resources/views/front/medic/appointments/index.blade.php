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
                        <th>Date</th>
                        <th>Time</th>
                        <th>Specialty</th>
                        <th>Patient</th>
                        <th>Age</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td class="border px-4 py-2">{{ $loop->index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $appointment->service_date }}</td>
                            <td class="border px-4 py-2">{{ $appointment->medicSchedule->schedule->time_range }}</td>
                            <td class="border px-4 py-2">{{ $appointment->medicSchedule->specialty->name }}</td>
                            <td class="border px-4 py-2">{{ $appointment->user->profile->first_name}} {{ $appointment->user->profile->last_name }}</td>
                            <td class="border px-4 py-2">{{ $appointment->user->profile->age }} {{ __('years') }}</td>
                            <td class="border px-4 py-2">
                                <a href="" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">View history</a>
                                @if($appointment->service_date==now()->format('Y-m-d'))
                                    <a href="{{ route('medic.appointments.show', $appointment->id_appointment) }}" class="bg-malachite-500 hover:bg-malachite-700 text-white font-bold py-2 px-4 rounded">Attend</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

