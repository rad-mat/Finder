<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Finder</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="buttom">Twoje konto</a>
                    @else
                        <a href="{{ route('login') }}" class="buttom" >Zaloguj się</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="buttom" >Utwórz konto</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 items-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Simple_4-quadrant_heart_curve.svg/625px-Simple_4-quadrant_heart_curve.svg.png?20140731081052" height="120px" width="150px">
                    <h1 class="text-gray-900 dark:text-white text-s60 ml-2"> &#x3A6;<strong>NDER</strong></h1>
                </div>

                <div class="mt-8 bg-gray-900 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center justify-center">
                                <h3 class="text-main">Znajdź swoją parę!</h3>
                            </div>
                            <div class="flex items-center justify-center mt-8 mb-6">
                                <a href="{{ route('login') }}">
                                    <img src="{{asset('assets/para.jpg')}}" alt="Logo" style="height: 460px; width: 500px;">                                </a>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center justify-center">
                                <h3 class="text-main">Rozwiąż zagadkę!</h3>
                            </div>
                            <div class="flex items-center justify-center mt-8 mb-6">
                                <a href="{{ route('riddles.index') }}">
                                        <img src="{{asset('assets/zagadki.jpg')}}" alt="Logo" style="height: 460px; width: 500px;">
                                    </a>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                            <a class="ml-1">
                                Tylko tutaj znajdziesz swojego matematycznego świrka
                            </a>

                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-1 -mt-px w-5 h-5 text-gray-400">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Portal dla matematyków
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
