<!-- resources/views/admin/medics/schedules/edit.blade.php -->
<div>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Assign Specialties and Schedules to Medic') }}
        </h1>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form wire:submit.prevent="assignMedicSchedule">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-label for="medic" value="{{ __('Medic') }}" />
                            <input class="rounded border-gray-300 text-malachite-600 shadow-sm focus:ring-malachite-500" type="text" value="{{ $medic->profile->first_name }}" />
                        
                        </div>

                    
                            <div class="col-span-2">
                                <x-label for="specialties" value="{{ __('Specialty') }}" />
                                
                                    <div class="flex items-center mb-4">
                                        <input class="rounded border-gray-300 text-malachite-600 shadow-sm focus:ring-malachite-500" type="text" value="{{ $specialty->name }}" />
                                    </div>
                                
                            </div>


                            <div class="col-span-2">
                                    <x-label for="id_schedules" value="{{ __('Schedule') }}:"/>
                                    <div
                                        class="dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 gap-1">
                                        @foreach ($days as $id => $day)
                                            <label class="ms-3">{{ $day }}
                                            @foreach ($timeRanges->where('day_id', $id) as $schedule)
                                                <div class="flex items-center m-2">
                                                    <input
                                                        class="rounded border-gray-300 text-malachite-600 dark:text-malachite-300 shadow-sm focus:ring-malachite-500"
                                                        type="checkbox" wire:model.defer="id_schedules"
                                                        value="{{ $schedule->id_schedule }}"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                        @if(in_array($schedule->id_schedule, $id_schedules)) checked @endif
                                                        @if(in_array($schedule->id_schedule, $id_other_schedules)) disabled="true" @endif
                                                    />
                                                    <label class="ms-3 @if(in_array($schedule->id_schedule, $id_other_schedules)) text-gray-300 @endif">
                                                        {{  $schedule->time_range  }}</label>
                                                </div>
                                            @endforeach
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('id_schedules') <span>{{ $message }}</span> @enderror
                                </div>
                        

                            <div class="col-span-2">
                                <x-button class="me-2" type="submit">{{ __('Update Schedules') }}</x-button>
                                <x-secondary-button type="button"
                                            wire:click="closeModal()">{{ __('Cancel') }}</x-secondary-button>
                            </div>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
