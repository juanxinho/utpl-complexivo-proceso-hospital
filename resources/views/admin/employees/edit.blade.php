<!-- resources/views/livewire/edit.blade.php-->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form wire:submit.prevent="updateEmployee">
                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">First Name:</label>
                    <input type="text" id="first_name"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="profile.first_name" required>
                    @error('profile.first_name') <span>{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Last Name:</label>
                    <input type="text" id="last_name"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="profile.last_name" required>
                    @error('profile.last_name') <span>{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="nid" class="block text-gray-700 text-sm font-bold mb-2">National ID:</label>
                    <input type="text" id="nid"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="profile.nid" required>
                    @error('profile.nid') <span>{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone:</label>
                    <input type="text" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="profile.phone" required>
                    @error('profile.phone') <span>{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Gender:</label>
                    <x-select id="gender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="gender" class="block mt-1 w-full" :options="['M' => __('Male'), 'F' => __('Female')]" wire:model="profile.gender" required/>
                    @error('profile.gender') <span>{{ $message }}</span> @enderror
                    </select>
                </div>

                <div class="mb-4">
                    <label for="dob" class="block text-gray-700 text-sm font-bold mb-2">Date of Birth:</label>
                    <input type="date" id="dob"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="profile.dob" required>
                    @error('profile.dob') <span>{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="email" required>
                    @error('email') <span>{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="roles" class="block text-gray-700 text-sm font-bold mb-2">Roles:</label>
                        @foreach($roles as $role)
                        <div class="flex items-center mb-4">
                            <input type="checkbox" wire:model.defer="idroles"  value="{{ $role->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                @foreach ($idroles as $rolId)
                                    @if(in_array($role->id, $idroles)) checked @endif
                                @endforeach
                            />
                            <label>{{ $role->name }}</label>
                        </div>
                        @endforeach
                        @error('idroles') <span>{{ $message }}</span> @enderror
                    </select>
                </div>

                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        <x-button type="submit">{{ __('Update') }}</x-button>
                        <x-button type="button" wire:click="closeModal()">{{ __('Cancel') }}</x-button>
                    </div>
            </form>
        </div>
    </div>
</div>
