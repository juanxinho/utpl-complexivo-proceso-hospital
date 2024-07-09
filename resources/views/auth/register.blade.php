<x-guest-layout>
    <x-authentication-card-register>
        <x-slot name="logo">
            <x-authentication-card-logo/>
        </x-slot>

        <x-validation-errors class="mb-4"/>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <livewire:register-form />
            <div class="flex items-center justify-end mt-5">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-malachite-500"
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card-register>
</x-guest-layout>
