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
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-6">
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
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->first_name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2 text-xs" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2 text-xs" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- First name -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="first_name" value="{{ __('First name') }}" />
            <x-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="state.first_name" autocomplete="first_name" />
            <x-input-error for="first_name" class="mt-2" />
        </div>

        <!-- Last name -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="last_name" value="{{ __('Last name') }}" />
            <x-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="state.last_name" autocomplete="last_name" />
            <x-input-error for="last_name" class="mt-2" />
        </div>

        <!-- NID -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="nid" value="{{ __('NID') }}" />
            <x-input id="nid" type="text" class="mt-1 block w-full" wire:model.defer="state.nid" autocomplete="nid" />
            <x-input-error for="nid" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="phone" value="{{ __('Phone') }}" />
            <x-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone" autocomplete="phone" />
            <x-input-error for="phone" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="gender" value="{{ __('Gender') }}" />
            <x-select id="gender" name="gender" class="block mt-1 w-full" :options="['M' => __('Male'), 'F' => __('Female')]" wire:model.defer="state.gender" />
            <x-input-error for="gender" class="mt-2" />
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="dob" value="{{ __('Date of birth') }}" />
            <x-date-picker id="dob" type="date" name="dob" class="block mt-1 w-full" defaultdate="{{$this->user->profile->dob }}" wire:model.defer="state.dob" />
            <x-input-error for="dob" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-malachite-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->user->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-malachite-600 dark:text-malachite-300">
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
