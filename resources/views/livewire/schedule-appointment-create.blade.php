<!-- resources/views/livewire/schedule-appointment-create.blade.php-->
<div class="w-full mx-auto py-10 sm:px-6 lg:px-8">
    <x-form-section submit="schedule">
        <x-slot name="title">
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
                {{ __('Schedule Appointment') }}
            </h1>
        </x-slot>

        <x-slot name="description">
            {{ __('Schedule a new appointment with a doctor.') }}
        </x-slot>

        <x-slot name="form">
            @hasanyrole('admin|super-admin')
            <div class="col-span-2">
                <x-label for="patient" value="{{ __('Search for a patient') }}" />
                @include('livewire.patient-select')
            </div>
            @endhasanyrole
            @hasanyrole('patient')
            <div class="col-span-2 lg:col-span-1">
                <x-label for="patient" value="{{ __('Patient') }}" />
                <x-input id="patient" type="text" class="mt-1 block w-full cursor-not-allowed" value="{{ $patient->profile->first_name }} {{ $patient->profile->last_name }}" disabled readonly />
            </div>
            @endhasanyrole

            <div class="col-span-2 lg:col-span-1">
                <x-label for="specialty" value="{{ __('Specialty') }}" />
                <x-select id="specialty" name="specialty" :options="$specialties" wire:model.live="specialty_id" class="mt-1 block w-full" placeholder="{{  __('Select an option' )}}"/>
                <x-input-error for="specialty_id" class="mt-2" />
            </div>

            <div class="col-span-2 lg:col-span-1">
                <x-label for="medic" value="{{ __('Medic') }}" />
                <x-select id="medic" name="medic" :options="$medics" wire:model.live="medic_id" class="mt-1 block w-full" placeholder="{{  __('Select an option' )}}"/>
                <x-input-error for="medic_id" class="mt-2" />
            </div>

            <div class="col-span-2 lg:col-span-1">
                <x-label for="date" value="{{ __('Date') }}" />
                <x-input id="date" type="date" min="{{ $today }}" max="{{ $maxDate }}" wire:model.live="date" class="mt-1 block w-full" />
                <x-input-error for="date" class="mt-2" />
            </div>

            <div class="col-span-2 lg:col-span-1">
                <x-label for="time" value="{{ __('Time') }}" />
                <x-select id="time" name="time" :options="$times" wire:model.live="time" class="mt-1 block w-full" placeholder="{{  __('Select an option' )}}"/>
                <x-input-error for="time" class="mt-2" />
            </div>

            <div class="col-span-2">
                <x-label for="reason" value="{{ __('Reason') }}" />
                <textarea rows="3" id="reason" wire:model.defer="reason"
                          class="dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-malachite-600 focus:ring-malachite-600 dark:focus:border-malachite-300 dark:focus:ring-malachite-300 rounded-md shadow-sm w-full"></textarea>
                <x-input-error for="reason" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="mr-3" on="saved">
                {{ __('Scheduled') }}.
            </x-action-message>

            <x-button>
                {{ __('Schedule') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>
