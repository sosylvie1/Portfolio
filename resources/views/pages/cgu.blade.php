@extends('layouts.app')

@section('title', 'Conditions Générales d’Utilisation')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Conditions Générales d’Utilisation</h1>

    <div class="space-y-8 bg-white shadow rounded-lg p-6 leading-relaxed text-gray-700">

        <section>
            <h2 class="text-xl font-semibold mb-2">1. Objet</h2>
            <p>
                Les présentes conditions régissent l’utilisation du site portfolio. En naviguant sur ce site,
                vous acceptez les conditions décrites ci-dessous.
            </p>
        </section>

        <section>
            <h2 class="text-xl font-semibold mb-2">2. Accès au site</h2>
            <p>
                Le site est accessible gratuitement à tout utilisateur disposant d’un accès Internet.
                Tous les frais liés à la connexion restent à la charge de l’utilisateur.
            </p>
        </section>

        <section>
            <h2 class="text-xl font-semibold mb-2">3. Propriété intellectuelle</h2>
            <p>
                L’ensemble du contenu du site (textes, images, codes, logos) est protégé par les lois
                sur la propriété intellectuelle. Toute reproduction sans autorisation est interdite.
            </p>
        </section>

        <section>
            <h2 class="text-xl font-semibold mb-2">4. Responsabilités</h2>
            <p>
                L’éditeur du site met tout en œuvre pour fournir des informations fiables,
                mais ne saurait être tenu responsable des erreurs ou omissions.
            </p>
        </section>

        <section>
            <h2 class="text-xl font-semibold mb-2">5. Données personnelles</h2>
            <p>
                Les données collectées sont traitées conformément à notre
                <a href="{{ route('confidentialite') }}" class="text-blue-600 hover:underline">
                    Politique de confidentialité
                </a>.
            </p>
        </section>

        <section>
            <h2 class="text-xl font-semibold mb-2">6. Modification des CGU</h2>
            <p>
                Les présentes conditions peuvent être modifiées à tout moment. Les utilisateurs
                sont invités à les consulter régulièrement.
            </p>
        </section>

    </div>
</div>
@endsection
