<x-guest-layout>
    @auth
        @include('layouts.navigation')
    @endauth

    <div class="mt-6 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="flex justify-center flex-nowrap items-center" >
            @guest
                <div class="">
                    <a href="/">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Simple_4-quadrant_heart_curve.svg/625px-Simple_4-quadrant_heart_curve.svg.png?20140731081052" height="100px" width="120px" class="pt-4">
                    </a>
                </div>
            @endguest
            <div class="ml-12 flex flex-col sm:justify-center items-center">
                <h1 class="mb-4">Zagadki</h1>
                <div class="mb-4">
                    <form method="post" action={{route("riddles.random")}}>
                        @csrf
                        <x-primary-button id="random-riddle" class="ml-3">
                            {{ __('Wylosuj zagadkę') }}
                        </x-primary-button>
                    </form>
                </div>
                <div class="">
                    <div>
                        <form method="post" action={{route("riddles.filter")}}>
                            @csrf
                            <div class="flex flex-nowrap sm:justify-center items-center space-x-3">

                                @auth
                                    <x-input-label for="answeredBoxValue" :value="__('Tylko nierozwiązane')"/>
                                    <input id="answeredBoxValue" class="ml-3" type="checkbox" name="answeredBoxValue" @if($isAnsweredChecked) checked @endif />
                                @endauth

                                <select name="category" class="ml-3">
                                    <option @if($selected == "all")selected="selected" @endif value="all">wszystkie kategorie
                                    </option>
                                    @foreach($categories as $category)
                                        <option value="{{$category}}"
                                                @if($selected == $category) selected="selected" @endif>{{$category}}</option>
                                    @endforeach
                                </select>

                                <x-primary-button id="riddles-filter" class="ml-3">
                                    {{ __('Filtruj') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <div class="w-full sm:max-w-2xl mt-6 px-6 py-4 bg-gray-900 text-white shadow-md overflow-hidden sm:rounded-lg">
            <dl class="max-w-2xl text-white divide-y divide-gray-200 text-white dark:divide-gray-700">
                @foreach($riddles as $riddle)
                    <div class="flex flex-col pb-3 riddle">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                            <a href="{{ route('riddles.show', $riddle) }}">@if(in_array($riddle->id, $answered)) <span class="text-green-700">✓</span> @endif {{ $riddle->title }}</a>
                        </dt>
                        <dd class="text-lg font-semibold">
                            @markdown($riddle->question)
                        </dd>
                    </div>
                @endforeach
            </dl>
        </div>
        <div class="mt-3">
            <a href="{{ route('riddles.page', last(request()->segments()) - 1) }}">
                <x-secondary-button id="riddles-previous" name="riddles-previous">
                    {{ __('<') }}
                </x-secondary-button>
            </a>

            <span id="riddles-page-number" class="ml-2 mr-2">{{ last(request()->segments()) }}</span>

            <a href="{{ route('riddles.page', last(request()->segments()) + 1) }}">
                <x-secondary-button id="riddles-next" name="riddles-next">
                    {{ __('>') }}
                </x-secondary-button>
            </a>
        </div>
    </div>
</x-guest-layout>
