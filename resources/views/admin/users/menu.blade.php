<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('users') }}" :active="request()->routeIs('users')">{{ __('List') }}</x-menu-link>
<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" wire:click="create()">{{ __('Add new user') }}</x-menu-link>
<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('admin.roles.index') }}" :active="request()->routeIs('admin.roles.index')">{{ __('Roles') }}</x-menu-link>
