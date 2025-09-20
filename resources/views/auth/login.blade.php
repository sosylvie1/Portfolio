{{-- resources/views/auth/login.blade.php --}}

@section('title', 'Connexion')
@section('robots', 'noindex, nofollow')

<x-guest-layout>
    {{-- Logo --}}
    <div class="flex justify-center mb-6">
        <img src="{{ asset('images/logo.webp') }}" alt="Logo personnel de Sylvie Seguinaud" class="h-20 w-auto"
            loading="lazy" decoding="async">
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                          focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm pr-10">

            <!-- Bouton œil (piloté par custom.js) -->
            <button type="button" data-toggle-password
                class="absolute inset-y-0 right-0 top-6 pr-3 flex items-center text-gray-500">

                <!-- Icône œil ouvert -->
                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0
                             8.268 2.943 9.542 7-1.274 4.057-5.065
                             7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>

                <!-- Icône œil barré -->
                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973
                             9.973 0 012.873-4.818m3.842-2.452A9.97 9.97 0 0112 5c4.477 0
                             8.268 2.943 9.542 7a9.97 9.97 0 01-4.39 5.818M15 12a3 3 0
                             11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                </svg>
            </button>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500" name="remember">
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

                <button type="submit" class="px-6 py-2 bg-pink-600 text-white rounded-lg shadow hover:bg-pink-700">
                    Se connecter
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>
