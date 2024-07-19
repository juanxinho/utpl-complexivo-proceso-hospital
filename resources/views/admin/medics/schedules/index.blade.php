<!-- resources/views/admin/medics/schedules/index.blade.php-->
<div>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Medic Specialties and Schedules') }}
        </h1>
    </x-slot>
    <div class="py-2">
        @foreach ($medics as $medicName => $specialties)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-fixed">
                    <thead class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
                    <tr>
                        <th scope="col" class="w-1/8 px-6 py-3 text-center">
                            {{ __('Medic') }}
                        </th>
                        <th scope="col" class="w-1/8 px-6 py-3 text-center">
                            {{ __('Specialty') }}
                        </th>
                        @foreach ($days as $day)
                            <th scope="col" class="w-1/8 px-6 py-3 text-center">
                                {{ $day }}
                            </th>
                        @endforeach
                        {{--<th scope="col" class="px-6 py-3 text-center">
                            {{ __('Actions') }}
                        </th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($specialties as $specialtyName => $specialtyDays)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="border px-6 py-4 text-center">{{ $medicName }}</td>
                            <td class="border px-6 py-4 text-center">{{ $specialtyName }}</td>
                            @foreach ($days as $day)
                                <td class="border px-6 py-4 text-center">
                                    @if (isset($specialtyDays[$day]))
                                        <ul class="list-disc list-inside">
                                            @foreach ($specialtyDays[$day] as $timeRange)
                                                <li>{{ $timeRange }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                            @endforeach
                            {{--<td class="px-6 py-4 text-center">
                                <button wire:click="edit({{ $medics->id }})" class="text-gray-600 dark:text-gray-300"><x-monoicon-edit-alt width="20" height="20" /></button>
                                <button wire:click="delete({{ $medics->id }})" class="text-red-600 dark:text-red-500"><x-monoicon-delete-alt width="20" height="20" /></button>
                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>
