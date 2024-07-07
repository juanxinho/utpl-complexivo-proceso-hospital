<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('admin.roles.index') }}" :active="request()->routeIs('admin.roles.index')">{{ __('List') }}</x-menu-link>
<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('admin.roles.create') }}" :active="request()->routeIs('admin.roles.create')">{{ __('Create new role') }}</x-menu-link>
<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('users') }}">{{ __('Users') }}</x-menu-link>
