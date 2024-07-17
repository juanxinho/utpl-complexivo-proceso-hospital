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
                            <td class="px-6 py-4 text-center">{{ ucfirst(\Carbon\Carbon::parse($appointment->service_date)->translatedFormat('l, j \d\e F \d\e Y')) }}</td>
                            <td class="px-6 py-4 text-center">{{ $appointment->medicSchedule->schedule->time_range }}</td>
                            <td class="px-6 py-4 text-center">{{ $appointment->medicSchedule->specialty->name }}</td>
                            <td class="px-6 py-4 text-center">{{ $appointment->user->profile->first_name}} {{ $appointment->user->profile->last_name }}</td>
                            <td class="px-6 py-4 text-center">{{ $appointment->user->profile->age }} {{ __('years') }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('patient.history', $appointment->user->id) }}"
                                   class="inline-block mb-2 xl:mb-0 xl:me-2 items-center px-4 py-2 bg-malachite-600 dark:bg-malachite-300 border border-transparent rounded-md font-semibold text-sm text-white dark:text-gray-800 tracking-widest hover:bg-malachite-700 dark:hover:bg-malachite-400 focus:bg-malachite-700 active:bg-malachite-900 focus:outline-none focus:ring-2 focus:ring-malachite-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                                    {{ __('View history' )}}
                                </a>
                                <a href="{{ route('attend-patient', $appointment->id_appointment) }}"
                                   class="inline-block items-center px-4 py-2 bg-white md:dark:bg-transparent border border-malachite-600 dark:border-malachite-300 rounded-md font-bold text-sm text-malachite-600 dark:text-malachite-300 tracking-widest shadow-sm hover:bg-malachite-600 hover:text-white dark:hover:text-gray-800 dark:hover:bg-malachite-300 focus:outline-none focus:ring-2 dark:focus:ring-malachite-300 focus:ring-malachite-600 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 {{ $appointment->service_date != now()->format('Y-m-d') ? 'opacity-50 cursor-not-allowed' : '' }}">
                                    {{ __('Attend') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
