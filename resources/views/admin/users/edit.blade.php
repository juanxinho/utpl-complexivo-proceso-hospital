<!-- resources/views/admin/users/edit.blade.php-->
<div class="py-2">
    <div class="mx-auto sm:px-6 lg:px-2 pb-4 pt-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
            {{ __('Edit user') }}
        </h2>
    </div>
    @include('admin.users.menu')
    <div class="mx-auto sm:px-6 lg:px-2">
        <div class="flex flex-col">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form wire:submit.prevent="store">
                    <div
                        class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-gray-400 shadow sm:rounded-tl-md sm:rounded-tr-md">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="profile.first_name" value="{{ __('First name') }}:"/>
                                <x-input type="text" class="mt-1 block w-full" wire:model="profile.first_name"/>
                                @error('profile.first_name') <span>{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="profile.last_name" value="{{ __('Last name') }}:"/>
                                <x-input type="text" class="mt-1 block w-full" wire:model="profile.last_name"/>
                                @error('profile.last_name') <span>{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="profile.nid" value="{{ __('NID') }}:"/>
                                <x-input type="text" class="mt-1 block w-full" wire:model="profile.nid"/>
                                @error('profile.nid') <span>{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="profile.phone" value="{{ __('Phone') }}:"/>
                                <x-input type="text" class="mt-1 block w-full" wire:model="profile.phone"/>
                                @error('profile.phone') <span>{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="profile.gender" value="{{ __('Gender') }}:"/>
                                <x-select id="gender" name="gender" class="block mt-1 w-full" :options="['M' => __('Male'), 'F' => __('Female')]" wire:model="profile.gender" placeholder="Select an option" />
                                @error('profile.gender') <span>{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="profile.dob" value="{{ __('Date of birth') }}:"/>
                                <x-date-picker id="dob" type="date" name="dob" class="block mt-1 w-full" defaultdate="{{$profile['dob'] }}" wire:model="profile.dob" />
                                @error('profile.dob') <span>{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="email" value="{{ __('Email') }}:"/>
                                <x-input type="email" class="mt-1 block w-full" wire:model="email"/>
                                @error('email') <span>{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="id_roles" value="{{ __('Role') }}:"/>
                                @foreach ($roles as $role)
                                    <div class="flex items-center mb-4">
                                        <input class="rounded border-gray-300 text-malachite-600 dark:text-malachite-300 shadow-sm focus:ring-malachite-500" type="checkbox" wire:model.defer="id_roles"  value="{{ $role->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"

                                               @foreach ($id_roles as $id_role)
                                                   @if(in_array($role->id, $id_roles)) checked @endif
                                                @endforeach
                                        />
                                    <label class="ms-3">{{ $role->name }}</label>
                                    </div>
                                @endforeach

                                @error('id_roles') <span>{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        <x-button class="me-2" type="submit">{{ __('Save') }}</x-button>
                        <x-secondary-button type="button" wire:click="closeModal()">{{ __('Cancel') }}</x-secondary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
