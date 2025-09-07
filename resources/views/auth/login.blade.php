@extends('layouts.app')

@section('title', 'Connexion')
@section('robots', 'noindex, nofollow')


<x-guest-layout>
    {{-- Logo --}}
    <div class="flex justify-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Sylvie Seguinaud" class="h-20 w-auto">
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500" name="remember">
            <label for="remember_me" class="ms-2 text-sm text-gray-600">Se souvenir de moi</label>
        </div>

        <!-- Actions -->
        <div class="text-center">
            <p class="text-gray-600 mb-2">Pas encore enregistré ?</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('register') }}"
                   class="px-6 py-2 bg-white border border-gray-300 rounded-lg shadow hover:bg-gray-100">
                    Créer un compte
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-pink-600 text-white rounded-lg shadow hover:bg-pink-700">
                    Se connecter
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>
