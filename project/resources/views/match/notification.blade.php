<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Znajdz pare') }}
        </h2>
    </x-slot>
    {{-- adapted from resources/views/components/auth-card.blade.php --}}
    <div class="min-h-screen flex flex-col items-center pt-8 py-4 rounded-md">
        <div class=" w-full sm:max-w-2xl mt-6 px-6 py-4 bg-gray-900 text-white  shadow-md overflow-hidden sm:rounded-lg justify-center">

            <div class="flex flex-row justify-center p-3"><h1>Znaleziono parę!</h1></div>
            <div class="flex flex-row justify-around my-5 p-4">
                <a href="/match/show" class="inline-block bg-emerald-600 text-white p-3 rounded" id="go-to-pairs">Przejdź do listy znalezionych par</a>
                <a href="/match/find" class="inline-block bg-emerald-600 text-white p-3 rounded" id="find-more">Szukaj dalej</a>
            </div>

        </div>
    </div>
</x-app-layout>
