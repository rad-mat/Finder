<x-guest-layout>
    @auth
        @include('layouts.navigation')
    @endauth
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <h1>{{ $riddle->title }}</h1>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @markdown($riddle->question)

            @auth
                @if(!$solved)
                    <form method="post" action={{route( "riddles.answer")}} class="mt-3">
                        @csrf
                        <div class="flex flex-nowrap sm:justify-center items-center space-x-3">
                            <x-input-label for="fill-answer" :value="__('Odpowiedź')"/>

                            <x-text-input id="riddleId" type="hidden" name="riddleId" value="{{last(request()->segments())}}"/>
                            <x-text-input id="filledAnswer" class="ml-3" type="number" name="filledAnswer" required autofocus />

                            <x-primary-button id="send-answer" class="ml-3">{{ __('Sprawdź') }}</x-primary-button>
                        </div>
                        <x-input-error :messages="$errors->get('riddle')" class="mt-2" />
                    </form>
                @else
                    <div class="flex sm:justify-center mt-6">
                        <p>Zagadka rozwiązana!</p>
                    </div>
                @endif
            @endauth

            <div class="flex flex-col sm:justify-center items-center">
                <a href="{{ route('riddles.index') }}"
                   class="font-medium text-blue-600 dark:text-blue-500 mt-8">
                    <x-primary-button id="riddle-back" class="ml-3">
                        {{ __('Powrót') }}
                    </x-primary-button>
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
