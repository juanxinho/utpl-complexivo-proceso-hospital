<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('patients') }}" :active="request()->routeIs('patients')">{{ __('List') }}</x-menu-link>
<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" wire:click="create()">{{ __('Add new patient') }}</x-menu-link>
