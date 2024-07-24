@if($isOpenEdit)
    @include('admin.medics.schedules.edit')
@endif

<div>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Assign Specialties and Schedules to Medic') }}
        </h1>
    </x-slot>
    <div class="py-2">

        @include('admin.medics.schedules.actions')

        @foreach ($usermedics as $medic)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-fixed">
                    <thead
                        class="text-xs text-malachite-600 uppercase bg-malachite-100 dark:bg-malachite-300 dark:text-gray-800">
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
                        <th scope="col" class="w-1/8 px-6 py-3 text-center">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($medic->specialties as $specialty)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="border px-6 py-4 text-center">{{ $medic->profile->first_name }} {{ $medic->profile->last_name }}</td>
                            <td class="border px-6 py-4 text-center">{{ $specialty->name }}</td>
                            @foreach ($days as $day_id => $day)
                                <td class="border px-6 py-4 text-center">
                                @foreach ($medic->medicSchedules as $medicSchedule)
                                    @if ($medicSchedule->id_specialty == $specialty->id_specialty)
                                        @if ($medicSchedule->schedule->day->id==$day_id)
                                            <ul class="list-disc list-inside">
                                                <li>{{ $medicSchedule->schedule->time_range }}</li>
                                            </ul>
                                        @endif
                                    @endif
                                @endforeach
                                </td>
                            @endforeach
                            <td class="border px-6 py-4 text-center">
                                <button
                                    wire:click="edit({{ $medic->id}}, {{$specialty->id_specialty}})"
                                    class="text-gray-600 dark:text-gray-300">
                                    <x-monoicon-edit-alt width="20" height="20"/>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $usermedics->links() }}
        </div>

    </div>
</div>
