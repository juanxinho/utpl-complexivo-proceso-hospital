<div>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Attend Patient') }}: {{ $patient->profile->first_name }} {{ $patient->profile->last_name }}
    </h2>

    <form wire:submit.prevent="save">

        <div class="mt-4">
            <h3 class="text-lg font-semibold text-gray-800 leading-tight dark:text-white">{{ __('Diagnostics') }}</h3>
            @foreach($diagnostics as $index => $diagnostic)
                <div class="flex mt-2">
                    <x-select id="diagnosticIds.{{ $index }}" name="diagnosticIds.{{ $index }}" wire:model.defer="diagnosticIds.{{ $index }}" class="block w-full" :options="$availableDiagnostics->pluck('description', 'id')" required />
                    <x-secondary-button class="ml-2" wire:click.prevent="removeDiagnostic({{ $index }})">{{ __('Remove') }}</x-secondary-button>
                </div>
            @endforeach
            <x-secondary-button class="mt-2" wire:click.prevent="addDiagnostic">{{ __('Add Diagnostic') }}</x-secondary-button>
        </div>

        <div class="mt-4">
            <h3 class="text-lg font-semibold text-gray-800 leading-tight dark:text-white">{{ __('Medical Tests') }}</h3>
            @foreach($medicalTests as $index => $test)
                <div class="flex mt-2">
                    <x-select id="medicalTestIds.{{ $index }}" name="medicalTestIds.{{ $index }}" wire:model.defer="medicalTestIds.{{ $index }}" class="block w-full" :options="$availableMedicalTests->pluck('name', 'id')" required />
                    <x-secondary-button class="ml-2" wire:click.prevent="removeMedicalTest({{ $index }})">{{ __('Remove') }}</x-secondary-button>
                </div>
            @endforeach
            <x-secondary-button class="mt-2" wire:click.prevent="addMedicalTest">{{ __('Add Medical Test') }}</x-secondary-button>
        </div>

        <div class="mt-4">
            <x-label value="{{ __('Prescription') }}" />
            @foreach($prescriptionItems as $index => $item)
                <div class="flex items-center mt-2">
                    <x-select id="prescriptionItems.{{ $index }}.stock_id" name="prescriptionItems.{{ $index }}.stock_id" wire:model.defer="prescriptionItems.{{ $index }}.stock_id" class="block w-full" :options="$stocks->pluck('item_name', 'id')" required />
                    <x-input wire:model.defer="prescriptionItems.{{ $index }}.quantity" type="number" class="ml-2 block w-20" min="1" required />
                    <x-button wire:click.prevent="removePrescriptionItem({{ $index }})" class="ml-2 bg-red-500 hover:bg-red-700">-</x-button>
                </div>
            @endforeach
            <x-button wire:click.prevent="addPrescriptionItem" class="mt-2 bg-green-500 hover:bg-green-700">+ Add Item</x-button>
            @error('prescriptionItems.*.stock_id') <span class="text-red-500">{{ $message }}</span> @enderror
            @error('prescriptionItems.*.quantity') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="nextControlDate" value="{{ __('Next Control Date') }}" />
            <x-input id="nextControlDate" type="date" class="mt-1 block w-full" wire:model.defer="nextControlDate" />
        </div>

        <div class="mt-4">
            <x-label for="recommendations" value="{{ __('Recommendations') }}" />
            <textarea id="recommendations" wire:model.defer="recommendations" class="block mt-1 w-full"></textarea>
        </div>

        <div class="mt-6">
            <x-button class="" wire:click.prevent="save">{{ __('Save') }}</x-button>
        </div>
    </form>
</div>
