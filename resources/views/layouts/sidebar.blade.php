<div class="w-64 bg-gray-800 text-white flex-shrink-0">
    <div class="p-4 text-center text-xl font-bold">
        {{ config('app.name', 'Laravel') }}
    </div>
    <nav class="mt-10">
        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            Dashboard
        </x-nav-link>
        <x-nav-link href="{{ route('usuarios') }}" :active="request()->routeIs('usuarios')">
            Gestión de Usuarios
        </x-nav-link>
    </nav>
</div>
