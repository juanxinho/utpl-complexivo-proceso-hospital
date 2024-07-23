<!-- resources/views/admin/medics/schedules/edit.blade.php -->
<div class="py-2">
    <div class="mx-auto sm:px-6 lg:px-2 pb-4 pt-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
            {{ __('Edit schedules by specialty') }}
        </h2>
    </div>

    <div class="mx-auto sm:px-6 lg:px-2">
        <div class="flex flex-col">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form wire:submit.prevent="assignMedicSchedule">
                    <div
                        class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-gray-400 shadow sm:rounded-tl-md sm:rounded-tr-md">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2 lg:col-span-1">
                                <x-label for="medic" value="{{ __('Medic') }}"/>
                                <x-input type="text" class="mt-1 block w-full cursor-not-allowed" value="{{ $medic->profile->first_name }}" disabled readonly />
                            </div>
                            <div class="col-span-2 lg:col-span-1">
                                <x-label for="specialties" value="{{ __('Specialty') }}"/>
                                <x-input type="text" class="mt-1 block w-full cursor-not-allowed" value="{{ $specialty->name }}" disabled readonly />
                            </div>
                            <div class="col-span-2">
                                <x-label for="id_schedules" value="{{ __('Schedule') }}:"/>
                                <div
                                    class="dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-1 mt-1">
                                    @foreach ($days as $id => $day)
                                        <div class="m-2">
                                            <x-label class="ms-2" value="{{ $day }}" />
                                            @foreach ($timeRanges->where('day_id', $id) as $schedule)
                                                <div class="flex items-center m-2">
                                                    <input
                                                        class="rounded border-gray-300 text-malachite-600 dark:text-malachite-300 shadow-sm focus:ring-malachite-500"
                                                        type="checkbox" wire:model.defer="id_schedules"
                                                        value="{{ $schedule->id_schedule }}"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                        @if(in_array($schedule->id_schedule, $id_schedules)) checked
                                                        @endif
                                                        @if(in_array($schedule->id_schedule, $id_other_schedules)) disabled="true" @endif
                                                    />
                                                    <label
                                                        class="ms-3 @if(in_array($schedule->id_schedule, $id_other_schedules)) text-gray-300 @endif">
                                                        {{  $schedule->time_range  }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                @error('id_schedules') <span>{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        <x-button class="me-2" type="submit">{{ __('Save') }}</x-button>
                        <x-secondary-button type="button"
                                            wire:click="closeModal()">{{ __('Cancel') }}</x-secondary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
