{{-- resources/views/auth/reset-password.blade.php --}}

@section('title', 'Réinitialiser le mot de passe')
@section('robots', 'noindex, nofollow')

<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Token caché -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" 
                          type="email" name="email" 
                          :value="old('email', $request->email)" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Nouveau mot de passe')" />

            <x-text-input id="password" 
                          class="block mt-1 w-full pr-10"
                          type="password"
                          name="password" required autocomplete="new-password" />

            <!-- Bouton œil -->
            <button type="button" data-toggle-password
                    class="absolute inset-y-0 right-0 top-6 pr-3 flex items-center text-gray-500">
                <!-- Icône œil ouvert -->
                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" 
                     class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 
                             8.268 2.943 9.542 7-1.274 4.057-5.065 
                             7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <!-- Icône œil barré -->
                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" 
                     class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973 
                             9.973 0 012.873-4.818m3.842-2.452A9.97 9.97 0 0112 5c4.477 0 
                             8.268 2.943 9.542 7a9.97 9.97 0 01-4.39 5.818M15 12a3 3 0 
                             11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3l18 18" />
                </svg>
            </button>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
