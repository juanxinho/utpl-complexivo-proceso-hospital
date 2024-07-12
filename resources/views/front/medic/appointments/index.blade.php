<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Appointment calendar') }}
        </h1>
    </x-slot>

    <div class="py-2">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
                <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Number') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            {{ __('Date') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            {{ __('Time') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            {{ __('Specialty') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            {{ __('Patient') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            {{ __('Age') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($appointments as $appointment)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">{{ $loop->index + 1 }}</td>
                            <td class="px-6 py-4 text-center">{{ $appointment->service_date }}</td>
                            <td class="px-6 py-4 text-center">{{ $appointment->medicSchedule->schedule->time_range }}</td>
                            <td class="px-6 py-4 text-center">{{ $appointment->medicSchedule->specialty->name }}</td>
                            <td class="px-6 py-4 text-center">{{ $appointment->user->profile->first_name}} {{ $appointment->user->profile->last_name }}</td>
                            <td class="px-6 py-4 text-center">{{ $appointment->user->profile->age }} {{ __('years') }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('patient.history', $appointment->user->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">View history</a>
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
</x-app-layout>
