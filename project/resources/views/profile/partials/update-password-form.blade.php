<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Zmień hasło') }}
        </h2>

        <p class="mt-1 text-sm text-white">
            {{ __('Pamiętaj o tym, by hasło było bezpieczne.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="text-gray-900">
            <x-input-label class="text-white" for="current_password" :value="__('Obecne hasło')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error class="text-white" :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="text-gray-900">
            <x-input-label class="text-white" for="password" :value="__('Nowe hasło')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error class="text-white" :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="text-gray-900">
            <x-input-label class="text-white" for="password_confirmation" :value="__('Potwierdź nowe hasło')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error class="text-white" :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Zapisz') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Zapisano.') }}</p>
            @endif
        </div>
    </form>
</section>
