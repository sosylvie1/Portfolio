<x-guest-layout>
     {{-- Logo perso (optionnel) --}}
    <div class="flex justify-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Sylvie Seguinaud" class="h-32 w-auto">
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if (session('error'))
  <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded mb-4">
    {{ session('error') }}
  </div>
@endif


    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        
       {{-- Bas du formulaire : responsive 2 colonnes --}}
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 items-start">

            {{-- Colonne gauche : inscription --}}
            <div class="text-center sm:text-left">
                <p class="text-sm text-gray-700 mb-2">Pas encore enregistré&nbsp;?</p>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="inline-block w-full sm:w-auto px-4 py-2 rounded-lg border bg-gray 300 hover:bg-gray-400 shadow text-center">
                        Créer un compte
                    </a>
                @endif
            </div>

            {{-- Colonne droite : mdp oublié + bouton login --}}
            <div class="flex flex-col items-center sm:items-end text-center sm:text-right gap-2">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                       href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif

                {{-- Bouton login même style que "Créer un compte" --}}
                <button type="submit"
                        class="inline-block w-full sm:w-auto px-4 py-2 rounded-lg bg-gray 300 hover:bg-gray-400 shadow text-center">
                    Se connecter
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>