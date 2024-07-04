<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('users') }}" :active="request()->routeIs('users')">{{ __('List') }}</x-menu-link>
<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" wire:click="create()">{{ __('Add new user') }}</x-menu-link>
<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('roles.index') }}" :active="request()->routeIs('roles.index')">{{ __('Manage roles') }}</x-menu-link>
<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('roles.create') }}" :active="request()->routeIs('roles.create')">{{ __('Create new role') }}</x-menu-link>
