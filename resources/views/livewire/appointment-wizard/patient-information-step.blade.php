<div>
    <x-label for="selectedUserId" value="{{ __('Select Your Account') }}" />
    <select id="selectedUserId" wire:model="selectedUserId" class="block mt-1 w-full">
        <option value="">{{ __('Select User') }}</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->profile->first_name }} {{ $user->profile->last_name }}</option>
        @endforeach
    </select>
    <x-input-error for="selectedUserId" class="mt-2" />

    <x-button wire:click="validateAndProceed">{{ __('Next') }}</x-button>
</div>

