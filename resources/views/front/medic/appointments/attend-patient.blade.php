<div>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Attend Patient') }}: {{ $patient->profile->first_name }} {{ $patient->profile->last_name }}
        </h1>
    </x-slot>

    <form wire:submit.prevent="save">
        <div class="max-w-7xl mx-auto px-0 md:p-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
                {{ __('Diagnostics') }}
            </h2>
        </div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-0 md:p-2">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="mt-4">
                        @foreach($diagnostics as $index => $diagnostic)
                            <div class="flex mt-2">
                                <x-select id="diagnosticIds.{{ $index }}" name="diagnosticIds.{{ $index }}"
                                          wire:model.defer="diagnosticIds.{{ $index }}" class="block w-full"
                                          :options="$availableDiagnostics->pluck('description', 'id')" 
                                          placeholder="{{  __('Select diagnostics' )}}" required/>
                                <x-button wire:click.prevent="removeDiagnostic({{ $index }})"
                                          class="ml-2 bg-red-500 hover:bg-red-700 dark:bg-red-300 dark:hover:bg-red-500">{{ __('Remove') }}
                                </x-button>
                            </div>
                        @endforeach
                        <x-button class="mt-2" wire:click.prevent="addDiagnostic">
                            + {{ __('Add Diagnostic') }}</x-button>
                        @error('diagnosticIds') <span class="text-red-600">{{ $message }}</span> @enderror
                            
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-0 md:p-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
                {{ __('Medical Tests') }}
            </h2>
        </div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-0 md:p-2">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="mt-4">
                        @foreach($medicalTests as $index => $test)
                            <div class="flex mt-2">
                                <x-select id="medicalTestIds.{{ $index }}" name="medicalTestIds.{{ $index }}"
                                          wire:model.defer="medicalTestIds.{{ $index }}" class="block w-full"
                                          :options="$availableMedicalTests->pluck('name', 'id')"
                                          placeholder="{{  __('Select medical Tests' )}}" required/>
                                <x-button wire:click.prevent="removeMedicalTest({{ $index }})"
                                          class="ml-2 bg-red-500 hover:bg-red-700 dark:bg-red-300 dark:hover:bg-red-500">{{ __('Remove') }}
                                </x-button>
                            </div>
                        @endforeach
                        <x-button class="mt-2" wire:click.prevent="addMedicalTest">
                            + {{ __('Add Medical Test') }}</x-button>   
                        @error('medicalTestIds') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-0 md:p-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
                {{ __('Prescription') }}
            </h2>
        </div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-0 md:p-2">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="mt-4">
                        @foreach($prescriptionItems as $index => $item)
                            <div class="flex items-center mt-2">
                                <x-select id="prescriptionItems.{{ $index }}.stock_id"
                                          name="prescriptionItems.{{ $index }}.stock_id"
                                          wire:model.defer="prescriptionItems.{{ $index }}.stock_id"
                                          class="block w-full" :options="$stocks->pluck('item_name', 'id')" 
                                          placeholder="{{  __('Select prescriptions' )}}" required/>
                                <x-input wire:model.defer="prescriptionItems.{{ $index }}.quantity" type="number"
                                         class="ml-2 block w-20" min="1" required/>
                                <x-button wire:click.prevent="removePrescriptionItem({{ $index }})"
                                          class="ml-2 bg-red-500 hover:bg-red-700 dark:bg-red-300 dark:hover:bg-red-500">{{ __('Remove') }}
                                </x-button>
                            </div>
                        @endforeach
                        <x-button wire:click.prevent="addPrescriptionItem" class="mt-2">+ {{ __('Add Item') }}</x-button>
                        @error('prescriptionItems') <span class="text-red-600">{{ $message }}</span> @enderror
                        @error('prescriptionItems.*.stock_id') <span
                            class="text-red-500">{{ $message }}</span> @enderror
                        @error('prescriptionItems.*.quantity') <span
                            class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto px-0 md:p-2">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-t-lg p-6">
                    <div class="mt-4">
                        <x-label for="nextControlDate" value="{{ __('Next Control Date') }}"/>
                        <x-input id="nextControlDate" type="date" class="mt-1 block w-full"
                                 wire:model.defer="nextControlDate"/>
                        @error('nextControlDate') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="recommendations" value="{{ __('Recommendations') }}"/>
                        <textarea rows="3" id="recommendations" wire:model.defer="recommendations"
                                  class="dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-malachite-600 focus:ring-malachite-600 dark:focus:border-malachite-300 dark:focus:ring-malachite-300 rounded-md shadow-sm w-full"></textarea>
                        @error('nextControlDate') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div
                    class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <x-button class="" wire:click.prevent="save">{{ __('Save') }}</x-button>
                </div>
            </div>
        </div>
    </form>
</div>
