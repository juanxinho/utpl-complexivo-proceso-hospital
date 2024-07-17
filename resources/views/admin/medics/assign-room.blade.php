<!-- resources/views/admin/medics/edit.blade.php-->
<div class="py-2">
    <div class="mx-auto sm:px-6 lg:px-2 pb-4 pt-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
            {{ __('Assign Room') }}
        </h2>
    </div>
    @include('admin.medics.menu')
    <div class="mx-auto sm:px-6 lg:px-2">
        <div class="flex flex-col">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form wire:submit.prevent="storeAssignRoom">
                    <div
                        class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-gray-400 shadow sm:rounded-tl-md sm:rounded-tr-md">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-label for="selectedMedic" value="{{ __('Select Medic') }}" />
                                <x-select id="selectedMedic" name="selectedMedic" class="block mt-1 w-full"
                                          :options="$medicsRoom" wire:model.live="selectedMedic"
                                          placeholder="{{  __('Select a medic' )}}"/>
                                @error('medics') <span class="text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <x-label for="availableRooms" value="{{ __('Select a room') }}" />
                                <x-select id="availableRooms" name="availableRooms" class="block mt-1 w-full"
                                          :options="$availableRooms" wire:model.live="selectedRoom"
                                          placeholder="{{  __('Select room' )}}"/>
                                @error('rooms') <span class="text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        <x-button class="me-2" type="submit">{{ __('Save') }}</x-button>
                        <x-secondary-button type="button"
                                            wire:click="closeModal()">{{ __('Cancel') }}</x-secondary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
