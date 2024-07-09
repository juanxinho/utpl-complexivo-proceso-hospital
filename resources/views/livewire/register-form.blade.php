<!-- resources/views/livewire/register-form.blade.php-->
<div class="grid grid-cols-6 gap-6">
    <div class="col-span-6 sm:col-span-3">
        <x-label for="first_name" value="{{ __('First name') }}"/>
        <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                 :value="old('first_name')" required autofocus autocomplete="first_name"/>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <x-label for="last_name" value="{{ __('Last name') }}"/>
        <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                 :value="old('last_name')" required autofocus autocomplete="last_name"/>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <x-label for="nid" value="{{ __('NID') }}"/>
        <x-input id="nid" class="block mt-1 w-full" type="text" name="nid" :value="old('nid')" required
                 autofocus autocomplete="nid"/>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <x-label for="phone" value="{{ __('Phone') }}"/>
        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                 required autofocus autocomplete="phone"/>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <x-label for="gender" value="{{ __('Gender') }}"/>
        <x-select name="gender" id="gender" class="mt-1 block w-full"
                  :options="['M' => __('Male'), 'F' => __('Female')]" wire:model.defer="state.gender"
                  placeholder="{{  __('Select an option' )}}"/>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <x-label for="dob" value="{{ __('Date of birth') }}"/>
        <x-date-picker id="dob" class="block mt-1 w-full" name="dob" :value="old('dob')" required autofocus
                       autocomplete="dob"/>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <x-label for="email" value="{{ __('Email') }}"/>
        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                 required autocomplete="email"/>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <x-label for="country_id" value="{{ __('Country') }}"/>
        <x-select id="country_id" name="country_id" class="block mt-1 w-full" :options="$countries"
                  wire:model.live="state.country_id" placeholder="{{  __('Select a country' )}}"/>
    </div>
    <div class="col-span-6 sm:col-span-3">
        <x-label for="state_id" value="{{ __('State') }}"/>
        <x-select id="state_id" name="state_id" class="block mt-1 w-full" :options="$states"
                  wire:model.live="state.state_id" placeholder="{{  __('Select a state' )}}"/>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <x-label for="city_id" value="{{ __('City') }}"/>
        <x-select id="city_id" name="city_id" class="block mt-1 w-full" :options="$cities"
                  wire:model.live="state.city_id" placeholder="{{  __('Select a city' )}}"/>
    </div>
    <div class="col-span-6 sm:col-span-3">
        <x-label for="address" value="{{ __('Address') }}"/>
        <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                 required autofocus autocomplete="address"/>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <x-label for="password" value="{{ __('Password') }}"/>
        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                 autocomplete="new-password"/>
    </div>

    <div class="col-span-6 sm:col-span-3">
        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
        <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                 name="password_confirmation" required autocomplete="new-password"/>
    </div>

    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="col-span-6 sm:col-span-3">
            <x-label for="terms">
                <div class="flex items-center">
                    <x-checkbox name="terms" id="terms" required/>

                    <div class="ms-2">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-malachite-500">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-malachite-500">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </div>
                </div>
            </x-label>
        </div>
    @endif


</div>
