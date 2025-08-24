@extends('layouts.app')

@section('title', 'Plan du site')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Plan du site</h1>

    <div class="grid md:grid-cols-3 gap-8">

        {{-- Section principale --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Navigation principale</h2>
            <ul class="space-y-2">
                <li><a href="{{ route('accueil') }}" class="text-blue-600 hover:underline">Accueil</a></li>
                <li><a href="{{ route('a-propos') }}" class="text-blue-600 hover:underline">À propos</a></li>
                <li><a href="{{ route('projets.index') }}" class="text-blue-600 hover:underline">Projets</a></li>
                <li><a href="{{ route('cv') }}" class="text-blue-600 hover:underline">CV</a></li>
                <li><a href="{{ route('contact.submit') }}" class="text-blue-600 hover:underline">Contact</a></li>
            </ul>
        </div>

        {{-- Section utilisateur --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Espace utilisateur</h2>
            <ul class="space-y-2">
                @auth
                    <li><a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a></li>
                    <li><a href="{{ route('profile.show') }}" class="text-blue-600 hover:underline">Mon profil</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="text-blue-600 hover:underline">Connexion</a></li>
                    <li><a href="{{ route('register') }}" class="text-blue-600 hover:underline">Créer un compte</a></li>
                @endauth
            </ul>
        </div>

        {{-- Section légale --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Pages légales</h2>
            <ul class="space-y-2">
                <li><a href="{{ route('confidentialite') }}" class="text-blue-600 hover:underline">Politique de confidentialité</a></li>
                <li><a href="{{ route('cgu') }}" class="text-blue-600 hover:underline">Conditions générales d’utilisation</a></li>
                <li><a href="{{ route('plan-du-site') }}" class="text-blue-600 hover:underline">Plan du site</a></li>
            </ul>
        </div>

    </div>
</div>
@endsection
