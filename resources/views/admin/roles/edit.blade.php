<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Roles Management') }}
        </h1>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-2 pb-4 pt-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white h-[1.9rem]">
                {{ __('Edit Role') }}
            </h2>
        </div>
        @include('admin.roles.menu')
        <div class="mx-auto sm:px-6 lg:px-2">
            <div class="flex flex-col">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                        <div
                            class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-gray-400 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <x-label for="name" value="{{ __('Role Name') }}"/>
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                         value="{{ $role->name }}" required autofocus autocomplete="name"/>
                            </div>

                            <div class="mb-4">
                                <x-label for="description" value="{{ __('Description') }}"/>
                                <x-input id="description" class="block mt-1 w-full" type="text" name="description"
                                         value="{{ $role->description }}" required autofocus
                                         autocomplete="description"/>
                            </div>

                            <div class="mb-4">
                                <x-label for="permissions" value="{{ __('Permissions') }}"/>
                                @foreach ($permissions as $permission)
                                    <div>
                                        <label>
                                            <input type="checkbox" name="permissions[]"
                                                   value="{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div
                            class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                            <x-button class="me-2" type="submit">{{ __('Save') }}</x-button>
                            <x-secondary-button type="button"
                                                onclick="redirectToRolesIndex()">{{ __('Cancel') }}</x-secondary-button>
                        </div>
                        @push('scripts')
                            <script>
                                function redirectToRolesIndex() {
                                    window.location.href = "{{ route('admin.roles.index') }}";
                                }
                            </script>
                        @endpush
                        @stack('scripts')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
