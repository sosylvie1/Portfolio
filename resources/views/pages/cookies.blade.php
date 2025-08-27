@extends('layouts.app')

@section('title', 'Gestion des cookies')

@section('content')
<div class="flex justify-center mt-8 px-4">
    <div class="w-full max-w-lg">
        
        {{-- Message de succès / erreur centré --}}
        @if (session('success'))
            <div class="mb-6 text-center p-3 bg-green-100 text-green-800 border border-green-300 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 text-center p-3 bg-red-100 text-red-800 border border-red-300 rounded shadow">
                {{ session('error') }}
            </div>
        @endif

        {{-- Carte cookies --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4 text-center">🍪 Gestion des cookies</h2>

            <form method="POST" action="{{ route('cookie-consent.store') }}" class="space-y-3">
                @csrf

                <label class="flex items-center">
                    <input type="checkbox" checked disabled class="mr-2">
                    Cookies fonctionnels (toujours actifs)
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="analytics" value="1" class="mr-2">
                    Cookies analytiques
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="marketing" value="1" class="mr-2">
                    Cookies marketing
                </label>

                <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700">
                    💾 Enregistrer mes préférences
                </button>
            </form>
        </div>

        {{-- Boutons retour (stack mobile / row desktop) --}}
        <div class="flex flex-col sm:flex-row justify-center items-center gap-3 mt-6">
            <a href="{{ route('dashboard') }}" 
               class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded">
                ⬅ Retour à mon espace
            </a>
            <a href="{{ route('profile.edit') }}" 
               class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded">
                👤 Retour à mon profil
            </a>
        </div>
    </div>
</div>
@endsection
