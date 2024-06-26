<!-- resources/views/livewire/create.blade.php -->
<div>
    <form wire:submit.prevent="store">
        <input type="hidden" wire:model="idusuario">
        <div>
            <label for="persona.nombres">{{ __('Name') }}:</label>
            <input type="text" wire:model="persona.nombres">
            @error('persona.nombres') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="persona.apellidos">{{ __('Last name') }}:</label>
            <input type="text" wire:model="persona.apellidos">
            @error('persona.apellidos') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="persona.cedula">{{ __('ID') }}:</label>
            <input type="text" wire:model="persona.cedula">
            @error('persona.cedula') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="correo">{{ __('Email') }}:</label>
            <input type="email" wire:model="correo">
            @error('correo') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="clave">{{ __('Password') }}:</label>
            <input type="password" wire:model="clave">
            @error('clave') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="idrol">{{ __('Role') }}:</label>
            <select wire:model="idrol" multiple>
                @foreach($roles as $rol)
                    <option value="{{ $rol->idrol }}">{{ $rol->nombre }}</option>
                @endforeach
            </select>
            @error('idrol') <span>{{ $message }}</span> @enderror
        </div>
        <button type="submit">{{ __('Save') }}</button>
        <button type="button" wire:click="closeModal()">{{ __('Cancel') }}</button>
    </form>
</div>
