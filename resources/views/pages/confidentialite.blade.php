{{-- resources/views/confidentialite.blade.php --}}
@extends('layouts.app')

@section('title', 'Politique de confidentialité - Portfolio de Sylvie Seguinaud')

@section('content')
    <div class="bg-pink-50 py-12 sm:py-16" aria-labelledby="privacy-title">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 bg-white shadow-md rounded-2xl p-8 sm:p-12">

            {{-- Titre --}}
            <h1 id="privacy-title" class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6 text-center">
                Politique de confidentialité
            </h1>
            <p class="text-center text-pink-600 font-medium mb-10">
                Transparence et respect de vos données personnelles
            </p>

            {{-- Section 1 --}}
            <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">1. Responsable du traitement</h2>
            <p class="mb-4 text-gray-700">
                {{ config('app.name') }} – Contact : voir la page
                <a href="{{ url('/contact') }}" class="text-pink-600 underline hover:text-pink-800">Contact</a>.
            </p>

            {{-- Section 2 --}}
            <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">2. Données collectées</h2>
            <ul class="list-disc pl-6 mb-4 text-gray-700 space-y-1">
                <li>Cookies techniques indispensables (session Laravel, sécurité CSRF).</li>
                <li>Données de compte (si vous vous inscrivez / connectez) : email, nom, etc.</li>
                <li>Statistiques d’audience (uniquement si vous y avez consenti).</li>
            </ul>

            {{-- Section 3 --}}
            <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">3. Cookies</h2>
            <p class="mb-4 text-gray-700">
                Nous utilisons des cookies strictement nécessaires au fonctionnement du site.
                Les cookies non essentiels (mesure d’audience, intégrations tierces) ne sont activés
                qu’après votre consentement explicite via le bandeau dédié.
            </p>

            {{-- Section 4 --}}
            <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">4. Fondement juridique</h2>
            <ul class="list-disc pl-6 mb-4 text-gray-700 space-y-1">
                <li>Exécution du contrat (création de compte, accès à l’espace membre).</li>
                <li>Intérêt légitime (sécurité, prévention des abus, fonctionnement du site).</li>
                <li>Consentement (mesure d’audience, services tiers).</li>
            </ul>

            {{-- Section 5 --}}
            <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">5. Durée de conservation</h2>
            <p class="mb-4 text-gray-700">
                Les journaux de consentement sont conservés pendant la durée nécessaire
                (jusqu’à 13 mois pour les cookies non essentiels, sauf obligation contraire).
            </p>

            {{-- Section 6 --}}
            <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">6. Vos droits</h2>
            <p class="mb-4 text-gray-700">
                Vous disposez des droits d’accès, de rectification, d’effacement, de limitation et d’opposition.
                Pour les exercer, contactez-nous via la page
                <a href="{{ url('/contact') }}" class="text-pink-600 underline hover:text-pink-800">Contact</a>.
            </p>

            {{-- Section 7 --}}
            <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">7. Sécurité</h2>
            <p class="mb-4 text-gray-700">
                Nous mettons en œuvre des mesures techniques et organisationnelles appropriées pour protéger vos données.
            </p>

            {{-- Section 8 --}}
            <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">8. Contact</h2>
            <p class="text-gray-700">
                Pour toute question relative à cette politique, merci de nous écrire via la page
                <a href="{{ url('/contact') }}" class="text-pink-600 underline hover:text-pink-800">Contact</a>.
            </p>
        </div>
    </div>
@endsection

@push('head')
    <script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => 'Politique de confidentialité - Portfolio de Sylvie Seguinaud',
    'description' => 'Politique de confidentialité concernant les données collectées sur le portfolio de Sylvie Seguinaud.',
    'url' => url('/confidentialite'),
    'inLanguage' => 'fr',
    'mainEntity' => [
        '@type' => 'PrivacyPolicy',
        'name' => 'Politique de confidentialité - Portfolio de Sylvie Seguinaud',
        'url' => url('/confidentialite')
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush
