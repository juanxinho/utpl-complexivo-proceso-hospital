<!-- resources/views/livewire/medic-specialty-schedule-list.blade.php-->
<div>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
        {{ __('Medic Specialties and Schedules') }}
    </h2>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @foreach ($medics as $medicName => $specialties)
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">{{ $medicName }}</h3>
                        <table class="w-full table-auto mt-2">
                            <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">{{ __('Specialty') }}</th>
                                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                    <th class="px-4 py-2">{{ $day }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($specialties as $specialtyName => $days)
                                <tr>
                                    <td class="border px-4 py-2">{{ $specialtyName }}</td>
                                    @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <td class="border px-4 py-2">
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
    </div>
</div>
