{{-- resources/views/confidentialite.blade.php --}}
@extends('layouts.app')

@section('title', 'Politique de confidentialité')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-6">Politique de confidentialité</h1>

    <p class="mb-4">
        La présente politique de confidentialité explique quelles données nous collectons, pour quelles finalités et comment nous les protégeons lorsque vous utilisez ce site.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">1. Responsable du traitement</h2>
    <p class="mb-4">
        {{ config('app.name') }} – Contact : voir la page <a href="{{ url('/contact') }}" class="text-pink-600 underline">Contact</a>.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">2. Données collectées</h2>
    <ul class="list-disc pl-6 mb-4">
        <li>Cookies techniques indispensables (session Laravel, sécurité CSRF).</li>
        <li>Données de compte (si vous vous inscrivez / connectez) : email, nom, etc.</li>
        <li>Le cas échéant, statistiques d’audience (uniquement si vous y avez consenti).</li>
    </ul>

    <h2 class="text-xl font-semibold mt-6 mb-2">3. Cookies</h2>
    <p class="mb-4">
        Nous utilisons des cookies strictement nécessaires au fonctionnement du site.
        Les cookies non essentiels (mesure d’audience, intégrations tierces) ne sont activés qu’après votre consentement explicite via le bandeau dédié.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">4. Fondement juridique</h2>
    <ul class="list-disc pl-6 mb-4">
        <li>Exécution du contrat (création de compte, accès à l’espace membre).</li>
        <li>Intérêt légitime (sécurité, prévention des abus, fonctionnement du site).</li>
        <li>Consentement (mesure d’audience, services tiers).</li>
    </ul>

    <h2 class="text-xl font-semibold mt-6 mb-2">5. Durée de conservation</h2>
    <p class="mb-4">
        Les journaux de consentement sont conservés pendant la durée nécessaire (jusqu’à 13 mois pour les cookies non essentiels, sauf obligation contraire).
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">6. Vos droits</h2>
    <p class="mb-4">
        Vous disposez des droits d’accès, de rectification, d’effacement, de limitation et d’opposition.
        Pour les exercer, contactez‑nous via la page <a href="{{ url('/contact') }}" class="text-pink-600 underline">Contact</a>.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">7. Sécurité</h2>
    <p class="mb-4">
        Nous mettons en œuvre des mesures techniques et organisationnelles appropriées pour protéger vos données.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">8. Contact</h2>
    <p>
        Pour toute question relative à cette politique, merci de nous écrire via la page <a href="{{ url('/contact') }}" class="text-pink-600 underline">Contact</a>.
    </p>
</div>
@endsection
