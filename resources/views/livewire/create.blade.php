<!-- resources/views/livewire/create.blade.php -->
<div>
    <form wire:submit.prevent="store">
        <input type="hidden" wire:model="idusuario">
        <div>
            <label for="persona.nombres">Nombres:</label>
            <input type="text" wire:model="persona.nombres">
            @error('persona.nombres') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="persona.apellidos">Apellidos:</label>
            <input type="text" wire:model="persona.apellidos">
            @error('persona.apellidos') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="persona.cedula">Cédula:</label>
            <input type="text" wire:model="persona.cedula">
            @error('persona.cedula') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="correo">Correo:</label>
            <input type="email" wire:model="correo">
            @error('correo') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="clave">Clave:</label>
            <input type="password" wire:model="clave">
            @error('clave') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="idrol">Rol:</label>
            <select wire:model="idrol" multiple>
                @foreach($roles as $rol)
                    <option value="{{ $rol->idrol }}">{{ $rol->nombre }}</option>
                @endforeach
            </select>
            @error('idrol') <span>{{ $message }}</span> @enderror
        </div>
        <button type="submit">Guardar</button>
        <button type="button" wire:click="closeModal()">Cancelar</button>
    </form>
</div>
