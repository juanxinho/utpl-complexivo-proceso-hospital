<!-- resources/views/livewire/user-management.blade.php -->
<div>
    @if($isOpen)
        @include('livewire.create')
    @endif

    <button wire:click="create()">Nuevo Usuario</button>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    <table>
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Roles</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->persona->nombres }} {{ $usuario->persona->apellidos }}</td>
                <td>{{ $usuario->correo }}</td>
                <td>{{ implode(', ', $usuario->roles->pluck('nombre')->toArray()) }}</td>
                <td>
                    <button wire:click="edit({{ $usuario->idusuario }})">Editar</button>
                    <button wire:click="delete({{ $usuario->idusuario }})">Eliminar</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
