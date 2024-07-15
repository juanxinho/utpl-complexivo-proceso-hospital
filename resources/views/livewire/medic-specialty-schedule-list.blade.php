<!-- resources/views/livewire/medic-specialty-schedule-list.blade.php-->
<div>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Medic Specialties and Schedules') }}
        </h1>
    </x-slot>
    <div class="py-2">
        @foreach ($medics as $medicName => $specialties)
            <div class="mx-auto sm:px-6 lg:px-2 pb-4 pt-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
                    {{ $medicName }}
                </h2>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            {{ __('Specialty') }}
                        </th>
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <th scope="col" class="px-6 py-3 text-center">
                                {{ $day }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($specialties as $specialtyName => $days)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="border px-6 py-4 text-center">{{ $specialtyName }}</td>
                            @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <td class="border px-6 py-4 text-center">
                                    @if (isset($days[$day]))
                                        <ul class="list-disc list-inside">
                                            @foreach ($days[$day] as $timeRange)
                                                <li>{{ $timeRange }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>
