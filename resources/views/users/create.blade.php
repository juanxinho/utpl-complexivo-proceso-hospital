<div>
    {{var_dump($persona)}}

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
            {{--<label for="idroles">{{ __('Role') }}:</label>
            @foreach ($roles as $rol)
                <div class="flex items-center mb-4">
                    <input @foreach ($idroles as $id)
                               @if($id==$rol->id) checked @endif
                           @endforeach type="checkbox" id="idroles[]" name="idroles[]" value="{{ $rol->id }}"
                           wire:model='idroles.{{ $rol->id }}' wire:key="{{ $rol->id }}"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"/>
                    <label for="default-checkbox"
                           class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $rol->name }}</label>
                </div>
            @endforeach

            @error('idroles') <span>{{ $message }}</span> @enderror--}}
        </div>
        <button type="submit">{{ __('Save') }}</button>
        <button type="button" wire:click="closeModal()">{{ __('Cancel') }}</button>
    </form>
</div>
