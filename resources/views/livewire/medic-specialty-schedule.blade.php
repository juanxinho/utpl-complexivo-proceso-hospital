<!-- resources/views/livewire/medic-specialty-schedule.blade.php -->
<div>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
        {{ __('Assign Specialties and Schedules to Medic') }}
    </h2>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div>
                    <x-label for="medic" value="{{ __('Select Medic') }}" />
                    <select wire:model.live="selectedMedic" class="form-select block w-full mt-1">
                        <option value="">{{ __('Choose a medic') }}</option>
                        @foreach ($medics as $medic)
                            <option value="{{ $medic->id }}">{{ $medic->profile->first_name }} {{ $medic->profile->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mt-4">{{ __('Assign Specialties') }}</h3>
                    @foreach ($specialties as $specialty)
                        <div class="flex items-center mb-4">
                            <input type="checkbox" wire:model.live.defer="medicSpecialties" value="{{ $specialty->id_specialty }}" class="form-checkbox" />
                            <label class="ml-3">{{ $specialty->name }}</label>
                        </div>
                    @endforeach
                    <x-button wire:click="assignSpecialty">{{ __('Assign Specialties') }}</x-button>
                </div>
                @foreach ($medicSpecialties as $specialtyId)
                    <div class="bg-gray-100 p-4 mb-4 rounded-lg shadow-inner">
                        <h3 class="font-semibold text-lg">{{ $specialties->find($specialtyId)->name }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <x-label for="days" value="{{ __('Days') }}" />
                                <select wire:model.live.defer="specialtyDays.{{ $specialtyId }}" multiple class="form-multiselect mt-1 block w-full">
                                    @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2">
                                <x-label for="time_range" value="{{ __('Time Range') }}" />
                                @foreach ($specialtyDays[$specialtyId] ?? [] as $day)
                                    <div class="mb-2">
                                        <h4 class="font-medium">{{ $day }}</h4>
                                        <select wire:model.live.defer="specialtySchedules.{{ $specialtyId }}.{{ $day }}[]" multiple class="form-multiselect mt-1 block w-full">
                                            @foreach ($schedules as $schedule)
                                                <option value="{{ $schedule->id_schedule }}">{{ $schedule->time_range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <x-button wire:click="assignSchedule({{ $specialtyId }})">{{ __('Assign Schedule') }}</x-button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
