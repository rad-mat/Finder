<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Twój profil') }}
        </h2>
    </x-slot>
    @include('profile.view-profile')
</x-app-layout>
