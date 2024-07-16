<!-- resources/views/livewire/medic-specialty-schedule.blade.php -->
<div>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Assign Specialties and Schedules to Medic') }}
        </h1>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-label for="medic" value="{{ __('Select Medic') }}" />
                        <x-select id="medic" name="medic" wire:model.live="selectedMedic" :options="$medics->pluck('profile.full_name', 'id')" placeholder="{{ __('Select Medic') }}" />
                    </div>

                    @if($selectedMedic)
                        <div class="col-span-2">
                            <x-label for="specialties" value="{{ __('Select Specialties') }}" />
                            @foreach ($specialties as $specialty)
                                <div class="flex items-center mb-4">
                                    <input class="rounded border-gray-300 text-malachite-600 shadow-sm focus:ring-malachite-500" type="checkbox" wire:model.live="medicSpecialties" value="{{ $specialty->id_specialty }}" />
                                    <label class="ml-3">{{ $specialty->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        @foreach ($medicSpecialties as $specialtyId)
                            <div class="col-span-2">
                                <x-label value="{{ __('Select Days for ') . $specialties->find($specialtyId)->name }}" />
                                <x-select id="specialtyDays" name="specialtyDays" wire:model.live="specialtyDays.{{ $specialtyId }}" :options="$days" multiple class="form-multiselect mt-1 block w-full" />
                            </div>

                            @foreach ($specialtyDays[$specialtyId] ?? [] as $dayId)
                                <div class="col-span-2">
                                    <x-label value="{{ __('Select Schedules for ') . $days[$dayId] }}" />
                                    <x-select id="specialtySchedules" name="specialtySchedules" wire:model.live="specialtySchedules.{{ $specialtyId }}.{{ $dayId }}" :options="$schedules->pluck('time_range', 'id')" multiple class="form-multiselect mt-1 block w-full" />
                                </div>
                            @endforeach
                        @endforeach

                        <div class="col-span-2">
                            <x-button wire:click="assignSpecialty">{{ __('Assign Specialties') }}</x-button>
                            <x-button wire:click="assignSchedule({{ $selectedSpecialty }})">{{ __('Assign Schedules') }}</x-button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
