{{-- resources/views/cgu.blade.php --}}
@extends('layouts.app')

@section('title', 'Conditions Générales d’Utilisation')

@section('content')
<div class="bg-pink-50 py-12 sm:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 bg-white shadow-md rounded-2xl p-8 sm:p-12">

        {{-- Titre --}}
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6 text-center">
            Conditions Générales d’Utilisation
        </h1>
        <p class="text-center text-pink-600 font-medium mb-10">
            Merci de lire attentivement ces conditions avant d’utiliser ce site.
        </p>

        {{-- Sections --}}
        <section class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">1. Objet</h2>
            <p class="text-gray-700">
                Les présentes conditions régissent l’utilisation du site portfolio. En naviguant sur ce site,
                vous acceptez les conditions décrites ci-dessous.
            </p>
        </section>

        <section class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">2. Accès au site</h2>
            <p class="text-gray-700">
                Le site est accessible gratuitement à tout utilisateur disposant d’un accès Internet.
                Tous les frais liés à la connexion restent à la charge de l’utilisateur.
            </p>
        </section>

        <section class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">3. Propriété intellectuelle</h2>
            <p class="text-gray-700">
                L’ensemble du contenu du site (textes, images, codes, logos) est protégé par les lois
                sur la propriété intellectuelle. Toute reproduction sans autorisation est interdite.
            </p>
        </section>

        <section class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">4. Responsabilités</h2>
            <p class="text-gray-700">
                L’éditeur du site met tout en œuvre pour fournir des informations fiables,
                mais ne saurait être tenu responsable des erreurs ou omissions.
            </p>
        </section>

        <section class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">5. Données personnelles</h2>
            <p class="text-gray-700">
                Les données collectées sont traitées conformément à notre
                <a href="{{ route('confidentialite') }}" class="text-pink-600 hover:underline">
                    Politique de confidentialité
                </a>.
            </p>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-gray-800 mb-2">6. Modification des CGU</h2>
            <p class="text-gray-700">
                Les présentes conditions peuvent être modifiées à tout moment. Les utilisateurs
                sont invités à les consulter régulièrement.
            </p>
        </section>

    </div>
</div>
@endsection
