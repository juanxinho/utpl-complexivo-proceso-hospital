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
        @foreach($users as $user)
            <tr>
                <td>{{ $user->persona->nombres }} {{ $user->persona->apellidos }}</td>
                <td>{{ $user->correo }}</td>
                <td>{{ implode(', ', $user->roles->pluck('nombre')->toArray()) }}</td>
                <td>
                    <button wire:click="edit({{ $user->iduser }})">Editar</button>
                    <button wire:click="delete({{ $user->iduser }})">Eliminar</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
