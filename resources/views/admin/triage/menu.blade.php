<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('admin.triage.index') }}" :active="request()->routeIs('admin.triage.index')">Consulta</x-menu-link>
<x-menu-link class="mb-4 inline-block hover:underline font-medium py-2 px-4" href="{{ route('admin.triage.create') }}" :active="request()->routeIs('admin.triage.create')">Registro</x-menu-link>
