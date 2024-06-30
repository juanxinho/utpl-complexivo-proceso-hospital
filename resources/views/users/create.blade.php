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
            <input type="email" wire:model="email">
            @error('email') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="clave">{{ __('Password') }}:</label>
            <input type="password" wire:model="password">
            @error('password') <span>{{ $message }}</span> @enderror
        </div>
    
        <div>
            <label for="idroles">{{ __('Role') }}:</label>
            
            @foreach ($roles as $rol)
                <label>
                {{ $rol->name }}
                <input type="checkbox"  id="idroles[]" name="idroles[]" value="{{ $rol->id }}" wire:model='idroles.{{ $rol->id }}' wire:key="{{ $rol->id }}"
                    @foreach ($idroles as $id)
                        @if($id==$rol->id) checked @endif
                    @endforeach
                >
                </label>
            @endforeach
           
            @error('idroles') <span>{{ $message }}</span> @enderror
        </div>
        <button type="submit">{{ __('Save') }}</button>
        <button type="button" wire:click="closeModal()">{{ __('Cancel') }}</button>
    </form>
</div>
