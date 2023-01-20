<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Simple_4-quadrant_heart_curve.svg/625px-Simple_4-quadrant_heart_curve.svg.png?20140731081052" height="120px" width="150px">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Haslo')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Zapamietaj mnie') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Zapomniales hasla?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3" id="login-button">
                    {{ __('Zaloguj sie') }}
                </x-primary-button>
            </div>

            <hr class="mt-6">

            <div class="flex items-center justify-center mt-4">
                    <h3 class="text-gray-600">Nie masz jeszcze konta?</h3>
            </div>

            <div class="flex items-center justify-center mt-3">
                <x-primary-button id="login-button">
                    <a href="{{ route('register') }}"  >Utworz konto</a>
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
