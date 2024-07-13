<div>
    <div class="mb-4">
        <label for="patient-search" class="sr-only">{{ __('Search for a patient') }}</label>
        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <x-monoicon-search class="dark:text-gray-600" width="20" height="20"/>
            </div>
            <x-input type="text" id="patient-search" wire:model.live="searchPatient"
                     placeholder="{{ __('Search for a patient') }}" class="p-2 ps-10 mt-1 block w-full"/>
        </div>
        @if(!empty($patients))
            <ul class="mt-2 bg-white border rounded shadow-lg">
                @foreach($patients as $patient)
                    <li wire:click="selectPatient({{ $patient->id }})" class="p-2 hover:bg-gray-200 cursor-pointer">
                        {{ $patient->first_name }} {{ $patient->last_name }} - {{ $patient->nid }} ({{ $patient->email }})
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    @if(!empty($selectedPatient))
        <div class="mb-4">
            <h4>{{ __('Selected Patient') }}:</h4>
            <div class="flex items-center justify-between">
                {{ $selectedPatient->profile->first_name }} {{ $selectedPatient->profile->last_name }} - {{ $selectedPatient->profile->nid }} ({{ $selectedPatient->email }})
                <x-button wire:click="removePatient" class="ml-2 bg-red-500 hover:bg-red-700 dark:bg-red-300 dark:hover:bg-red-500">{{ __('Remove') }}</x-button>
            </div>
        </div>
    @endif
</div>
