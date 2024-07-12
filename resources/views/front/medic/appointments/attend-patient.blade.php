<div>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Attend Patient') }}: {{ $patient->profile->first_name }} {{ $patient->profile->last_name }}
    </h2>

    <form wire:submit.prevent="save">
        <div class="mt-4">
            <x-label for="diagnosis" value="{{ __('Diagnosis') }}" />
            <x-input id="diagnosis" type="text" class="mt-1 block w-full" wire:model.defer="diagnosis" required />
            @error('diagnosis') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label for="labTests" value="{{ __('Lab Tests') }}" />
            <x-input id="labTests" type="text" class="mt-1 block w-full" wire:model.defer="labTests" placeholder="Separate tests with commas" />
        </div>

        <div class="mt-4">
            <x-label for="imagingTests" value="{{ __('Imaging Tests') }}" />
            <x-input id="imagingTests" type="text" class="mt-1 block w-full" wire:model.defer="imagingTests" placeholder="Separate tests with commas" />
        </div>

        <div class="mt-4">
            <x-label value="{{ __('Prescription') }}" />
            @foreach($prescriptionItems as $index => $item)
                <div class="flex items-center mt-2">
                    <x-select wire:model.defer="prescriptionItems.{{ $index }}.stock_id" class="block w-full" :options="$stocks->pluck('item_name', 'id')" required />
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

        <div class="mt-6">
            <x-button class="bg-malachite-500 hover:bg-malachite-700">{{ __('Save') }}</x-button>
        </div>
    </form>
</div>
