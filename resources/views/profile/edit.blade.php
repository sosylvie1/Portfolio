@extends('layouts.app')

@section('title', 'Modifier mon profil')
@section('robots', 'noindex, nofollow')

@section('content')

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-100 border border-green-200 p-3 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">

                {{-- Formulaire mise à jour profil --}}
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    {{-- Société --}}
                    <div>
                        <x-input-label for="company_name" value="Nom de la société" />
                        <x-text-input id="company_name" name="company_name" type="text" class="block mt-1 w-full"
                            :value="old('company_name', $user->company_name)" />
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                    </div>

                    {{-- Nom --}}
                    <div>
                        <x-input-label for="name" value="Nom" />
                        <x-text-input id="name" name="name" type="text" class="block mt-1 w-full"
                            :value="old('name', $user->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email" class="block mt-1 w-full"
                            :value="old('email', $user->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Téléphone --}}
                    <div>
                        <x-input-label for="phone" value="Téléphone" />
                        <x-text-input id="phone" name="phone" type="text" class="block mt-1 w-full"
                            :value="old('phone', $user->phone)" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div><br>
                    <a href="{{ route('cookies.manage') }}">🍪 Gérer mes cookies</a>


                    {{-- Mot de passe (optionnel) --}}
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="password" value="Nouveau mot de passe (optionnel)" />
                            <x-text-input id="password" name="password" type="password" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="block mt-1 w-full" />
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <x-primary-button>Enregistrer</x-primary-button>
                        {{-- Retour au dashboard plutôt que profile.show --}}
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:underline">
                            Annuler
                        </a>
                    </div>
                    {{-- Boutons retour (stack mobile / row desktop) --}}
        <div class="flex flex-col sm:flex-row justify-center items-center gap-3 mt-6">
            <a href="{{ route('dashboard') }}" 
               class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded">
                ⬅ Retour à mon espace
            </a>
                </form>



                {{-- Suppression du compte --}}
                <hr>
                <details class="cursor-pointer">
                    <summary class="text-red-600 font-semibold">Supprimer mon compte</summary>
                    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4 space-y-4">
                        @csrf
                        @method('DELETE')
                        <div>
                            <x-input-label for="delete_password" value="Mot de passe" />
                            <x-text-input id="delete_password" name="password" type="password" class="block mt-1 w-full"
                                required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <x-danger-button>Supprimer</x-danger-button>
                    </form>
                </details>

            </div>
        </div>
    </div>
@endsection
