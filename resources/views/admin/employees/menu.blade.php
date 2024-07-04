<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('employees.index') }}" :active="request()->routeIs('employees.index')">{{ __('List') }}</x-menu-link>
<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" wire:click="create()">{{ __('Add new employee') }}</x-menu-link>
