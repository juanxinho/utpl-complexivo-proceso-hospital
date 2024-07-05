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
                    <x-select id="gender" name="gender" :options="['M' => __('Male'), 'F' => __('Female')]" wire:model="profile.gender" class="mt-1 block w-full"/>
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
                <div class="col-span-6 sm:col-span-3">
                    <x-label for="idroles" value="{{ __('Role') }}:"/>
                    @foreach ($roles as $role)
                        <div class="flex items-center mb-4">
                            <input type="checkbox" wire:model.defer="idroles"  value="{{ $role->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"/>
                            <label>{{ $role->name }}</label>
                        </div>
                    @endforeach

                    @error('idroles') <span>{{ $message }}</span> @enderror
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
