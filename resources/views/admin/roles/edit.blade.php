<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900 dark:text-gray-500 p-6">
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-label for="name" value="{{ __('Role Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $role->name }}" required autofocus autocomplete="name" />
                    </div>

                    <div class="mb-4">
                        <x-label for="description" value="{{ __('Description') }}" />
                        <x-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ $role->description }}" required autofocus autocomplete="description" />
                    </div>

                    <div class="mb-4">
                        <x-label for="permissions" value="{{ __('Permissions') }}" />
                        @foreach ($permissions as $permission)
                            <div>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Update Role') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
