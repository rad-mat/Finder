<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Znajdz pare') }}
        </h2>
    </x-slot>
    {{-- adapted from resources/views/components/auth-card.blade.php --}}
    <div class="min-h-screen flex flex-col items-center pt-8 py-4 rounded-md">
        <form action="/match/filter" method="post" class="flex flex-row justify-around items-center p-4 bg-white rounded">
            @csrf
            <div class="flex flex-col justify-center mx-3">
                <label>Płeć</label>
                <select name="sex">
                    <option value="all" {{$sex=="all"? 'selected': '' }}>Dowolna</option>
                    <option value="Mężczyzna" {{$sex=="Mężczyzna"? 'selected': '' }}>Mężczyzna</option>
                    <option value="Kobieta" {{$sex=="Kobieta"? 'selected': '' }}>Kobieta</option>
                </select>
            </div>
            <div class="flex flex-col bg-white rounded justify-center mx-3">
                <label class="">Minimalna liga</label>
                <select name="league">
                    <option value="0" {{$minLeague==0? 'selected': '' }}>{{App\Helpers\LeagueHelper::getLeague(0)}}</option>
                    <option value="1" {{$minLeague==1? 'selected': '' }}>{{App\Helpers\LeagueHelper::getLeague(1)}}</option>
                    <option value="2" {{$minLeague==2? 'selected': '' }}>{{App\Helpers\LeagueHelper::getLeague(2)}}</option>
                    <option value="3" {{$minLeague==3? 'selected': '' }}>{{App\Helpers\LeagueHelper::getLeague(3)}}</option>
                    <option value="4" {{$minLeague==4? 'selected': '' }}>{{App\Helpers\LeagueHelper::getLeague(4)}}</option>
                </select>
            </div>
            <button type="submit" name="filter" class="bg-blue-800 py-1 px-5 mx-2 rounded text-white flex-grow-0">Filtruj</button>
        </form>

        <div class=" w-full sm:max-w-2xl mt-6 px-6 py-4 bg-gray-900 text-white  shadow-md overflow-hidden sm:rounded-lg">
            @if($match)
                <div class="p-4 d-flex flex flex-col items-center space-y-4">
                    <h1 class="justify-center">Znaleziono matematyka!</h1>
                    @if(file_exists($match->imagePath()))
                        <img class="max-w-300 rounded-md" src="{{asset($match->imagePath())}}">
                    @else
                        <img class="max-w-300 rounded-md" src="{{asset("assets/profileImages/image_default.jpg")}}">
                    @endif
                    <h2>{{$match->profile->name . ' ' . $match->profile->surname}}</h2>
                    <h2>{{$match->profile->sex}}</h2>
                    <h2>{{$match->profile->description}}</h2>
                    <h2>{{$matchLeague}}</h2>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex justify-center flex-col">
                            <h2>Ulubiona liczba</h2>
                            <h2>{{$match->profile->favourite_number}}</h2>
                        </div>
                        <div class="flex flex-col justify-center">
                            <h2>Ulubiona funkcja</h2>
                            <h2>{{$match->profile->favourite_function}}</h2>
                        </div>
                    </div>
                </div>
            <div class="flex flex-col items-center">
                <form method="post">
                    @csrf
                    <input name="matchId" value="{{$match->id}}" class="hidden">
                    <input formaction="/match/accept" type="submit" name="accept" class="d-block bg-emerald-500 p-4 rounded"
                           value="Wspaniały biorę go!">
                    <input formaction="/match/deny" type="submit" name="deny"  class="d-block bg-red-500 p-4 rounded"
                           value="Meh, znajdź innego">
                </form>
            </div>
            @else
                <h1>Niestety nie znaleziono nikogo spełniającego twoje wymagania</h1>
            @endif


        </div>
    </div>
</x-app-layout>
