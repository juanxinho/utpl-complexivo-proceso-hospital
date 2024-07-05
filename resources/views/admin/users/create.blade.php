<x-app-layout>
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-md shadow-md">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">{{ __('Create User') }}</h2>
            <form wire:submit.prevent="store">
                @csrf
                <div class="mb-4">
                    <x-label for="first_name" :value="__('First Name')"/>
                    <x-input id="first_name" wire:model="profile.first_name" type="text" class="mt-1 block w-full"/>
                    @error('profile.first_name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <x-label for="last_name" :value="__('Last Name')"/>
                    <x-input id="last_name" wire:model="profile.last_name" type="text" class="mt-1 block w-full"/>
                    @error('profile.last_name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <x-label for="nid" :value="__('NID')"/>
                    <x-input id="nid" wire:model="profile.nid" type="text" class="mt-1 block w-full"/>
                    @error('profile.nid') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <x-label for="phone" :value="__('Phone')"/>
                    <x-input id="phone" wire:model="profile.phone" type="text" class="mt-1 block w-full"/>
                    @error('profile.phone') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <x-label for="gender" :value="__('Gender')"/>
                    <x-select id="gender" name="gender" wire:model="profile.gender" class="mt-1 block w-full">
                        <option value="M">{{ __('Male') }}</option>
                        <option value="F">{{ __('Female') }}</option>
                    </x-select>
                    @error('profile.gender') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <x-label for="dob" :value="__('Date of Birth')"/>
                    <x-input id="dob" wire:model="profile.dob" type="date" class="mt-1 block w-full"/>
                    @error('profile.dob') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <x-label for="email" :value="__('Email')"/>
                    <x-input id="email" wire:model="email" type="email" class="mt-1 block w-full"/>
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <x-label for="password" :value="__('Password')"/>
                    <x-input id="password" wire:model="password" type="password" class="mt-1 block w-full"/>
                    @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <x-label for="roles" :value="__('Roles')"/>
                    <x-select id="roles" name="roles" wire:model="idroles" multiple class="mt-1 block w-full">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </x-select>
                    @error('idroles') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="flex items-center justify-end">
                    <x-button class="bg-blue-500 hover:bg-blue-700">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
