@extends('layouts.app')

@section('title', 'inscription')
@section('robots', 'noindex, nofollow')


<x-guest-layout>
    {{-- Logo perso (optionnel) --}}
    <div class="flex justify-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Sylvie Seguinaud" class="h-32 w-auto">
    </div>
    <form method="POST" action="{{ route('register') }}">
        {{-- resources/views/auth/register.blade.php --}}
        @section('title', 'Inscription · ' . config('app.name'))

        @csrf

        <!-- Company Name -->
        <div>
            <x-input-label for="company_name" value="Nom de la société" />
            <x-text-input id="company" class="block mt-1 w-full" type="text" name="company"
                          :value="old('company')" autofocus autocomplete="organization" />
            <x-input-error :messages="$errors->get('company')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" value="Nom" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                          :value="old('name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="Adresse e-mail" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                          :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" value="Téléphone portable" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone"
                          :value="old('phone')" autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmation du mot de passe" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>