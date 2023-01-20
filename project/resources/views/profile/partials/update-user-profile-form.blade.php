<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Twój profil') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __('Daj się poznać innym! Im bardziej spersonalizowany jest Twój profil, tym większa szansa na dobre dopasowanie!') }}
        </p>
    </header>

    <form id="user-profile-form" method="post" action="{{ route('userProfile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="text-gray-900">
            <x-input-label class="text-white" for="name" :value="__('Imię')" />
            <x-text-input id="user-name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $userProfile->name)"/>
        </div>

        <div class="text-gray-900">
            <x-input-label class="text-white" for="surname" :value="__('Nazwisko')" />
            <x-text-input id="user-surname" name="surname" type="text" class="mt-1 block w-full" :value="old('surname', $userProfile->surname)"/>
        </div>

        <div class="text-gray-900">
            <x-input-label class="text-white" for="favourite_number" :value="__('Ulubiona liczba całkowita')" />
            <x-text-input id="user-favourite-number" name="favourite_number" type="number" class="mt-1 block w-full" :value="old('favourite_number', $userProfile->favourite_number)"/>
        </div>

        <div class="text-gray-900">
            <x-input-label class="text-white" for="favourite_function" :value="__('Ulubiona funkcja')" />
            <x-text-input id="user-favourite-function" name="favourite_function" type="text" class="mt-1 block w-full" :value="old('favourite_function', $userProfile->favourite_function)"/>
        </div>

        <div class="text-gray-900">
            <x-input-label class="text-white" for="sex" :value="__('Płeć')" />
            <select name="sex" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                <option value="Mężczyzna">Mężczyzna</option>
                <option value="Kobieta" @if($userProfile->sex == "Kobieta") selected="selected" @endif>Kobieta</option>
                <option value="Inna" @if($userProfile->sex == "Inna") selected="selected" @endif>Inna</option>
            </select>
        </div>

        <div class="text-gray-900">
            <x-input-label class="text-white" for="description" :value="__('Twój opis')" />
            <textarea id="user-description" name="description" form="user-profile-form"
                      class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full mt-1 h-120 w-full block">{{$userProfile->description ?? ""}}</textarea>
        </div>

        <div>
            <x-input-label class="text-white" for="picture" :value="__('Twoje zdjęcie profilowe')" />
            <input class="form-control" id="user-picture" name="picture" type="file" accept="image/jpeg"/>
        </div>
        @if(file_exists($profileImagePath))
        <div class="max-w-300 rounded-md">
            <img src="{{asset($profileImagePath)}}">
        </div>
        @else
        <div class="max-w-300 rounded-md">
            <img src="{{asset("assets/profileImages/image_default.jpg")}}">
        </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button id="user-profile-save">{{ __('Zapisz') }}</x-primary-button>

            @if (session('status') === 'userProfile-updated')
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
