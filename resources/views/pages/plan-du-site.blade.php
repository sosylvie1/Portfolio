{{-- resources/views/pages/plan-du-site.blade.php --}}
@extends('layouts.app')

@section('title', 'Plan du site')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4">

    <h1 class="text-3xl font-bold mb-8 text-gray-800">Plan du site</h1>

    <div class="space-y-8 bg-white/80 shadow rounded-xl p-6 sm:p-8 leading-relaxed text-gray-700 border border-pink-100">

        {{-- Section principale --}}
        <section>
            <h2 class="text-xl font-semibold mb-4 text-pink-600">Navigation principale</h2>
            <ul class="space-y-2 list-disc pl-5">
                <li><a href="{{ route('accueil') }}" class="text-blue-600 hover:underline">Accueil</a></li>
                <li><a href="{{ route('a-propos') }}" class="text-blue-600 hover:underline">À propos</a></li>
                <li><a href="{{ route('projets.index') }}" class="text-blue-600 hover:underline">Projets</a></li>
                <li><a href="{{ route('cv.public') }}" class="text-blue-600 hover:underline">CV</a></li>
                <li><a href="{{ route('contact.show') }}" class="text-blue-600 hover:underline">Contact</a></li>
            </ul>
        </section>

        {{-- Section utilisateur --}}
        <section>
            <h2 class="text-xl font-semibold mb-4 text-pink-600">Espace utilisateur</h2>
            <ul class="space-y-2 list-disc pl-5">
                @auth
                    <li><a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a></li>
                    <li><a href="{{ route('profile.show') }}" class="text-blue-600 hover:underline">Mon profil</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="text-blue-600 hover:underline">Connexion</a></li>
                    <li><a href="{{ route('register') }}" class="text-blue-600 hover:underline">Créer un compte</a></li>
                @endauth
            </ul>
        </section>

        {{-- Section légale --}}
        <section>
            <h2 class="text-xl font-semibold mb-4 text-pink-600">Pages légales</h2>
            <ul class="space-y-2 list-disc pl-5">
                <li><a href="{{ route('confidentialite') }}" class="text-blue-600 hover:underline">Politique de confidentialité</a></li>
                <li><a href="{{ route('cgu') }}" class="text-blue-600 hover:underline">Conditions générales d’utilisation</a></li>
                <li><a href="{{ route('plan-du-site') }}" class="text-blue-600 hover:underline">Plan du site</a></li>
            </ul>
        </section>

    </div>
</div>
@endsection
@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => 'Plan du site - Portfolio de Sylvie Seguinaud',
    'description' => 'Plan du site portfolio de Sylvie Seguinaud pour naviguer facilement entre les pages principales.',
    'url' => url('/plan-du-site'),
    'inLanguage' => 'fr',
    'mainEntity' => [
        '@type' => 'SiteNavigationElement',
        'name' => 'Navigation principale',
        'hasPart' => [
            [
                '@type' => 'WebPage',
                'name' => 'Accueil',
                'url' => route('accueil')
            ],
            [
                '@type' => 'WebPage',
                'name' => 'À propos',
                'url' => route('a-propos')
            ],
            [
                '@type' => 'WebPage',
                'name' => 'Projets',
                'url' => route('projets.index')
            ],
            [
                '@type' => 'WebPage',
                'name' => 'CV',
                'url' => route('cv.public')
            ],
            [
                '@type' => 'WebPage',
                'name' => 'Contact',
                'url' => route('contact.show')
            ],
            [
                '@type' => 'WebPage',
                'name' => 'Politique de confidentialité',
                'url' => route('confidentialite')
            ],
            [
                '@type' => 'WebPage',
                'name' => 'Conditions générales d’utilisation',
                'url' => route('cgu')
            ],
            [
                '@type' => 'WebPage',
                'name' => 'Plan du site',
                'url' => route('plan-du-site')
            ]
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush

