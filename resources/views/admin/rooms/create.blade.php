<!-- resources/views/admin/rooms/create.blade.php-->
<div class="py-2">
    <div class="mx-auto sm:px-6 lg:px-2 pb-4 pt-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
            {{ __('Create new room') }}
        </h2>
    </div>
    @include('admin.rooms.menu')
    <div class="mx-auto sm:px-6 lg:px-2">
        <div class="flex flex-col">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form wire:submit.prevent="store">
                    <div
                        class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-gray-400 shadow sm:rounded-tl-md sm:rounded-tr-md">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-label for="code" value="{{ __('Room Code') }}"/>
                                <x-input id="code" type="text" class="mt-1 block w-full" wire:model="code"/>
                                @error('code') <span class="text-red-600">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <x-label for="name" value="{{ __('Room Name') }}"/>
                                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name"/>
                                @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <x-label for="description" value="{{ __('Description') }}"/>
                                <x-input id="description" type="text" class="mt-1 block w-full"
                                         wire:model="description"/>
                                @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <x-label for="location" value="{{ __('Location') }}"/>
                                <x-input id="location" type="text" class="mt-1 block w-full" wire:model="location"/>
                                @error('location') <span class="text-red-600">{{ $message }}</span> @enderror
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
