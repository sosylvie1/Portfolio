@extends('layouts.app')

@section('title', 'À propos')
@section('body-class', 'a-propos-page') {{-- utile pour custom.js --}}

@section('content')
    <section class="bg-pink-50 py-16 px-4" aria-labelledby="about-title">
        <div class="max-w-5xl mx-auto space-y-10">

            <!-- Titre principal -->
            <h1 id="about-title" class="text-3xl md:text-4xl font-bold text-gray-900 text-center">
                En savoir plus sur moi
            </h1>

            <!-- Introduction personnelle -->
            <div class="space-y-4 text-gray-800 text-lg leading-relaxed">
                <p>
                    <strong>Née le 15 mars 1962 à Cannes</strong> — pour les fervents d’astrologie, ça fait de moi une
                    "Poissons" assumée 🐟, intuitive, créative, et un brin rebelle.
                </p>
                <p>
                    Je m'appelle <strong>Sylvie Seguinaud</strong>, j'ai 63 ans, et je viens d'achever une reconversion vers
                    le développement web après une vie professionnelle et personnelle bien remplie...
                </p>
            </div>

            <!-- Galerie de formation -->
            <div class="my-12 grid grid-cols-1 md:grid-cols-2 gap-6">
                <figure class="bg-white rounded-lg shadow-lg overflow-hidden text-center p-4 relative photo-container"
                        role="group" aria-labelledby="caption-formation-cannes">
                    <img src="{{ asset('images/formation-cannes.webp') }}"
                        alt="Photo du groupe de la formation développeuse web à Cannes"
                        class="protected-image mx-auto rounded-lg shadow max-w-full" loading="lazy">
                    <div class="watermark">© Sylvie Seguinaud</div>
                    <figcaption id="caption-formation-cannes" class="text-sm text-gray-600 mt-3">
                        Groupe de la formation web 👩‍💻
                    </figcaption>
                </figure>

                <figure class="bg-white rounded-lg shadow-lg overflow-hidden text-center p-4 relative photo-container"
                        role="group" aria-labelledby="caption-formation">
                    <img src="{{ asset('images/formation.webp') }}"
                        alt="Photo avec Hugo et Sylvie, le plus jeune et la plus âgée du groupe"
                        class="protected-image mx-auto rounded-lg shadow max-w-xs sm:max-w-sm" loading="lazy">
                    <div class="watermark">© Sylvie Seguinaud</div>
                    <figcaption id="caption-formation" class="text-sm text-gray-600 mt-3">
                        Le plus jeune (Hugo) et la plus âgée (moi) du groupe 😉
                    </figcaption>
                </figure>
            </div>

            <!-- Citation -->
            <blockquote class="mt-20 mb-12 border-l-4 border-pink-500 pl-6 italic text-pink-700 text-xl leading-relaxed">
                « Reconversion, pour moi, signifie ouverture, évolution, et liberté de créer autrement. »
            </blockquote>

            <!-- Ce que je recherche -->
            <section class="bg-white border-l-4 border-gray-400 pl-6 pr-4 py-6 my-16 shadow-md rounded"
                     aria-labelledby="goals-title">
                <h2 id="goals-title" class="text-2xl font-semibold text-gray-800 mb-4">
                    Ce que je recherche aujourd’hui
                </h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                    À 63 ans, je sais que certains employeurs peuvent être réticents...
                </p>
                <div class="flex flex-col sm:flex-row gap-4 mt-6">
                    <a href="{{ route('projets.index') }}"
                        class="block w-full sm:w-auto bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-lg font-medium shadow transition text-center">
                        Découvrir mes projets
                    </a>
                </div>
            </section>

            <!-- Compétences -->
            <section class="bg-pink-50 rounded-lg shadow p-6" aria-labelledby="skills-title">
                <h2 id="skills-title" class="text-2xl font-semibold text-gray-900 mb-4">Compétences principales</h2>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    <li>Développement web : Laravel, Blade, HTML5, CSS3, JavaScript, PHP</li>
                    <li>Responsive design avec Tailwind CSS</li>
                    <li>Base de données : MySQL, Eloquent ORM, migrations</li>
                    <li>Git, GitHub, WordPress, Visual Studio Code</li>
                    <li>Outils IA : ChatGPT, GitHub Copilot, Google Gemini</li>
                    <li>Organisation, rigueur, autonomie, écoute, bienveillance</li>
                    <li>Créativité, gestion administrative, accompagnement humain</li>
                </ul>
            </section>
        </div>
    </section>
@endsection
