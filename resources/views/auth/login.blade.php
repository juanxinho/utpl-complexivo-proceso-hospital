<x-guest-layout>
    <x-authentication-card>
        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <div>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <div class="text-center">
                <h1 class="text-2xl color-green font-bold">Hospital Isidro Ayora</h1>
                <h3 class="text-lg font-bold">{{ __('Log in') }}</h3>
            </div>

        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-col items-start sm:justify-start mt-4">
                <x-button class="mt-1 mb-2 w-full">
                    {{ __('Log in') }}
                </x-button>

                <x-button class="mt-1 mb-2 w-full" onclick="window.location='{{ route('register') }}'">
                    {{ __('Create Account') }}
                </x-button>

                @if (Route::has('password.request'))
                    <div class="mt-1 w-full">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
