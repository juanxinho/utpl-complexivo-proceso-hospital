<div>
    <div class="mt-4">
        <x-label for="country_id" value="{{ __('Country') }}" />
        <x-select id="country_id" name="country_id" class="block mt-1 w-full" :options="$countries" wire:model.live="state.country_id" placeholder="{{  __('Select a country' )}}"/>
    </div>
    <div class="mt-4">
        <x-label for="state_id" value="{{ __('State') }}" />
        <x-select id="state_id" name="state_id" class="block mt-1 w-full" :options="$states" wire:model.live="state.state_id" placeholder="{{  __('Select a state' )}}"/>
    </div>

    <div class="mt-4">
        <x-label for="city_id" value="{{ __('City') }}" />
        <x-select id="city_id" name="city_id" class="block mt-1 w-full" :options="$cities" wire:model.live="state.city_id" placeholder="{{  __('Select a city' )}}"/>
    </div>
    <div class="mt-4">
        <x-label for="address" value="{{ __('Address') }}" />
        <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
    </div>
</div>
