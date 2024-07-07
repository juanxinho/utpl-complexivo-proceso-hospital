<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('admin.specialties.index') }}" :active="request()->routeIs('admin.specialties.index')">{{ __('List') }}</x-menu-link>
<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" wire:click="create()">{{ __('Add new specialty') }}</x-menu-link>
<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('admin.medics.index') }}" :active="request()->routeIs('admin.medics.index')">{{ __('Medics') }}</x-menu-link>
