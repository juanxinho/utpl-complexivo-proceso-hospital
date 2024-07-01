<!-- resources/views/livewire/create.blade.php -->
<div>
    <form wire:submit.prevent="store">
        <input type="hidden" wire:model="idusuario">
        <div>
            <label for="profile.first_name">{{ __('Name') }}:</label>
            <input type="text" wire:model="profile.first_name">
            @error('profile.first_name') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="profile.last_name">{{ __('Last name') }}:</label>
            <input type="text" wire:model="profile.last_name">
            @error('profile.last_name') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="profile.nid">{{ __('ID') }}:</label>
            <input type="text" wire:model="profile.nid">
            @error('profile.nid') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="email">{{ __('Email') }}:</label>
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
                    <input type="checkbox" wire:model.defer="idroles"  value="{{ $rol->id }}"
                           @foreach ($idroles as $rolId)
                               @if($rolId==$rol->id) checked @endif
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
