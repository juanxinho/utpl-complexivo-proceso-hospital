<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Edit Appointment') }}
        </h1>
    </x-slot>

        <x-slot name="description">
            {{ __('Edit appointment with a doctor.') }}
            @if (session()->has('message'))
            <div>{{ session('message') }}</div>
            @endif
        </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900 dark:text-gray-500 p-6">    

                <form method="POST">
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="patient" value="{{ __('Patient') }}" />
                        <x-input id="patient" type="text" class="mt-1 block w-full" value="{{ $patient->profile->first_name }} {{ $patient->profile->last_name }}" readonly />
                    </div>
                    
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="specialty" value="{{ __('Specialty') }}" />
                        <x-select id="specialty" name="specialty" :options="$specialties" wire:model.live="specialty_id" class="mt-1 block w-full" placeholder="{{  __('Select an option' )}}"/>
                        <x-input-error for="specialty_id" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="medic" value="{{ __('Medic') }}" />
                        <x-select id="medic" name="medic" :options="$medics" wire:model.live="medic_id" class="mt-1 block w-full" placeholder="{{  __('Select an option' )}}"/>
                        <x-input-error for="medic_id" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="date" value="{{ __('Date') }}" />
                        <x-input id="date" type="date" wire:model.live="date" class="mt-1 block w-full" />
                        <x-input-error for="date" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="time" value="{{ __('Time') }}" />
                        <x-select id="time" name="time" :options="$times" wire:model.live="time" class="mt-1 block w-full" placeholder="{{  __('Select an option' )}}"/>
                        <x-input-error for="time" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Update Appointment') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

 
        
            

           
 
</x-app-layout>
