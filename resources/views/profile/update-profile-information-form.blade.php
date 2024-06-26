<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Nombres -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="nombres" value="{{ __('Name') }}" />
            <x-input id="nombres" type="text" class="mt-1 block w-full" value="{{$this->user->persona->nombres}}" autocomplete="nombres" />
            <x-input-error for="nombres" class="mt-2" />
        </div>

        <!-- Apellidos -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="apellidos" value="{{ __('Last name') }}" />
            <x-input id="apellidos" type="text" class="mt-1 block w-full" value="{{$this->user->persona->apellidos}}" autocomplete="apellidos" />
            <x-input-error for="apellidos" class="mt-2" />
        </div>

        <!-- Cedula -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="cedula" value="{{ __('ID') }}" />
            <x-input id="cedula" type="text" class="mt-1 block w-full" value="{{$this->user->persona->cedula}}" autocomplete="cedula" />
            <x-input-error for="cedula" class="mt-2" />
        </div>

        <!-- Telefono -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="telefono" value="{{ __('Phone') }}" />
            <x-input id="telefono" type="text" class="mt-1 block w-full" value="{{$this->user->persona->telefono}}" autocomplete="telefono" />
            <x-input-error for="telefono" class="mt-2" />
        </div>

        <!-- Sexo -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="sexo" value="{{ __('Sex') }}" />
            <x-select id="sexo" name="sexo" class="block mt-1 w-full" :options="['M' => 'Male', 'F' => 'Female']" value="{{$this->user->persona->sexo}}" />
            <x-input-error for="sexo" class="mt-2" />
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="fecha_nacimiento" value="{{ __('Date of birth') }}" />
            <x-bladewind::datepicker required="true"
                id="fecha_nacimiento"
                name="fecha_nacimiento"
                class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm w-full"
                format="yyyy-mm-dd"
                default_date="{{$this->user->persona->fecha_nacimiento}}"
            />
            <x-input-error for="fecha_nacimiento" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
