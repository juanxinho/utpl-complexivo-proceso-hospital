<!-- resources/views/livewire/schedule-appointment.blade.php-->
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-form-section submit="schedule">
        <x-slot name="title">
            {{ __('Schedule Appointment') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Schedule a new appointment with a doctor.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="patient" value="{{ __('Patient') }}" />
                <x-input id="patient" type="text" class="mt-1 block w-full" value="{{ $patient->profile->first_name }} {{ $patient->profile->last_name }}" readonly />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="specialty" value="{{ __('Specialty') }}" />
                <x-select id="specialty" name="specialty" :options="$specialties" wire:model.live="specialty_id" class="mt-1 block w-full" placeholder="Select an option"/>
                <x-input-error for="specialty_id" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="medic" value="{{ __('Medic') }}" />
                <x-select id="medic" name="medic" :options="$medics" wire:model.live="medic_id" class="mt-1 block w-full" placeholder="Select an option"/>
                <x-input-error for="medic_id" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="date" value="{{ __('Date') }}" />
                <x-input id="date" type="date" wire:model="date" class="mt-1 block w-full" />
                <x-input-error for="date" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="time" value="{{ __('Time') }}" />
                <x-select id="time" name="time" wire:model="time" class="mt-1 block w-full">
                    <option value="">{{ __('Select Time') }}</option>
                    @foreach($times as $time)
                        <option value="{{ $time->time }}">{{ $time->time }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="time" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="mr-3" on="saved">
                {{ __('Scheduled.') }}
            </x-action-message>

            <x-button>
                {{ __('Schedule') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>
