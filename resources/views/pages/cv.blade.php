@extends('layouts.app')

@section('content')
    <section class="bg-pink-50 py-16 px-4" aria-labelledby="parcours-title">
        <div class="max-w-5xl mx-auto space-y-12">

            <!-- Titre principal -->
            <div class="text-center">
                <h1 id="parcours-title" class="text-4xl font-bold text-gray-900">
                    Mon parcours professionnel
                </h1>

                <!-- ✅ Texte amélioré contraste -->
                <p class="text-pink-800 mt-2 italic font-semibold">
                    Téléchargez mon CV ou explorez-le ci-dessous
                </p>

                <!-- Bouton selon connexion -->
                <div class="mt-6">
                    @auth
                        <a href="{{ route('cv.download') }}"
                           class="px-4 py-2 rounded-lg bg-pink-600 text-white hover:bg-pink-700 shadow">
                            📥 Télécharger le CV
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 rounded-lg bg-gray-800 text-white hover:bg-black shadow">
                            🔒 Connectez-vous pour télécharger
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Profil -->
            <section aria-labelledby="profil-title">
                <div class="bg-white/60 backdrop-blur-md border border-pink-100 shadow-lg rounded-xl p-6 mt-12">
                    <h2 id="profil-title"
                        class="text-3xl font-extrabold text-gray-800 border-b-4 border-pink-400 pb-1 mb-6">
                        Profil
                    </h2>

                    <div class="md:flex md:items-start md:gap-6">
                        <!-- Infos texte -->
                        <div class="md:w-3/4 text-gray-800 leading-relaxed space-y-2">
                            <address class="not-italic">
                                📍 Le Cannet (06110) | 📱 06 07 65 44 33 |
                                <a href="mailto:sosylvie1@gmail.com"
                                   class="text-pink-800 hover:text-pink-900 underline font-bold">
                                   📧 sosylvie1@gmail.com
                                </a><br>
                                Permis B – Véhiculée
                            </address>
                            <p>
                                <strong>Née le 15 mars 1962 à Cannes</strong> — Poissons assumée 🐟, intuitive, créative, et
                                un brin rebelle.
                                Après 10 ans à l'étranger (Dubaï, USA, Mexique, Liban), je me suis reconvertie dans le
                                développement web à 63 ans.
                                Curieuse, passionnée, autonome, j’ai décidé de continuer à apprendre, contribuer, et créer.
                            </p>
                        </div>

                        <!-- Portrait -->
                        <figure class="md:w-1/4 mt-3 md:mt-0 flex justify-center" role="group"
                                aria-labelledby="caption-sylvie">
                            <div class="photo-container w-[360px] h-[160px] relative">
                                <img src="{{ asset('images/sylviecv.webp') }}"
                                     alt="Portrait professionnel de Sylvie Seguinaud"
                                     class="protected-image rounded-md shadow-md w-full h-full object-cover"
                                     width="405" height="304" loading="lazy" decoding="async">
                                <div class="watermark">© Sylvie Seguinaud</div>
                            </div>
                            <figcaption id="caption-sylvie" class="sr-only">
                                Portrait officiel de Sylvie Seguinaud
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </section>

            <!-- Expériences -->
            <section aria-labelledby="xp-title">
                <div class="bg-white/60 backdrop-blur-md border border-pink-100 shadow-lg rounded-xl p-6 mt-12">
                    <h2 id="xp-title"
                        class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-pink-300 inline-block pb-1">
                        Expériences professionnelles
                    </h2>
                    <ul class="space-y-6 text-gray-800 leading-relaxed list-outside list-disc ml-5">
                        <li>
                            <strong>Développement Web (Juin 2024 – juillet 2025)</strong><br>
                            Formation DWWM – LaPlateforme Cannes<br>
                            Projets Laravel, Blade, PHP, Tailwind, base de données<br>
                            Utilisation d’outils IA (ChatGPT) pour coder, documenter, structurer
                        </li>
                        <li>
                            <strong>Aide à la personne (2021 – aujourd’hui)</strong><br>
                            Accompagnement des personnes âgées à domicile avec bienveillance <br>
                            Aidant numérique
                        </li>
                        <li>
                            <strong>Cheffe d'entreprise – USA & Mexique (2011 – 2020)</strong><br>
                            Arkay Beverages, Beyond Spirits, Licorzone SA de CV<br>
                            Création et gestion de sociétés, production, e-commerce,<br>
                            Responsable Service Client et Gestion Logistique – Retours Produits & Stocks Entrepôt
                        </li>
                        <li>
                            <strong>Office Manager – Cannes (1981 – 2003)</strong><br>
                            Agence maritime – Glemot SA, Camy SARL<br>
                            Gestion administrative & comptable pour yachts privés
                        </li>
                    </ul>
                </div>
            </section>

            <!-- Compétences techniques -->
            <section aria-labelledby="skills-title">
                <div class="bg-white/60 backdrop-blur-md border border-pink-100 shadow-lg rounded-xl p-6 mt-12">
                    <h2 id="skills-title"
                        class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-pink-300 inline-block pb-1">
                        Compétences techniques & numériques
                    </h2>
                    <ul class="list-disc list-inside space-y-1 text-gray-800">
                        <li>HTML, CSS, JavaScript, PHP, Laravel, Blade</li>
                        <li>Tailwind CSS, responsive design</li>
                        <li>MySQL, Eloquent ORM, migrations Laravel</li>
                        <li>Git, GitHub, Visual Studio Code</li>
                        <li>WordPress, WooCommerce</li>
                        <li>Figma</li>
                        <li>Utilisation des IA : ChatGPT, GitHub Copilot</li>
                    </ul>
                </div>
            </section>

            <!-- Compétences humaines -->
            <section aria-labelledby="soft-skills-title">
                <div class="bg-white/60 backdrop-blur-md border border-pink-100 shadow-lg rounded-xl p-6 mt-12">
                    <h2 id="soft-skills-title"
                        class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-pink-300 inline-block pb-1">
                        Compétences humaines & transversales
                    </h2>
                    <ul class="list-disc list-inside space-y-1 text-gray-800">
                        <li>Organisation, rigueur, autonomie</li>
                        <li>Curiosité, autodidacte</li>
                        <li>Bienveillance, empathie, écoute</li>
                        <li>Sens du service & de la confidentialité</li>
                        <li>Gestion administrative & comptable</li>
                        <li>Respect des règles d’hygiène & sécurité</li>
                    </ul>
                </div>
            </section>

            <!-- Formations -->
            <section aria-labelledby="formations-title">
                <div class="bg-white/60 backdrop-blur-md border border-pink-100 shadow-lg rounded-xl p-6 mt-12">
                    <h2 id="formations-title"
                        class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-pink-300 inline-block pb-1">
                        Formations
                    </h2>
                    <ul class="list-disc list-inside text-gray-800 space-y-2">
                        <li>DWWM – Développeuse Web & Web Mobile – LaPlateforme – Cannes (2024/2025)</li>
                        <li>Billetterie AMADEUS – AFPA – Cannes (2022)</li>
                        <li>WordPress e-commerce – Autodidacte – Floride, USA</li>
                        <li>BEP Comptabilité – Lycée Les Fauvettes – Cannes</li>
                    </ul>
                </div>
            </section>

            <!-- Langues & Centres d’intérêt -->
            <section aria-labelledby="lang-centres-title">
                <div class="grid md:grid-cols-2 gap-8 mt-12">
                    <div class="bg-white/60 backdrop-blur-md border border-pink-100 shadow-lg rounded-xl p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-pink-300 inline-block pb-1">
                            Langues
                        </h2>
                        <ul class="space-y-2 text-gray-800 leading-relaxed">
                            <li><span class="font-semibold">Français</span> : natif</li>
                            <li><span class="font-semibold">Anglais</span> : intermédiaire supérieur (B2)</li>
                        </ul>
                    </div>
                    <div class="bg-white/60 backdrop-blur-md border border-pink-100 shadow-lg rounded-xl p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-pink-300 inline-block pb-1">
                            Centres d’intérêt
                        </h2>
                        <ul class="space-y-2 text-gray-800 leading-relaxed">
                            <li>Randonnée, nature, photographie</li>
                            <li>Nouvelles technologies, animaux</li>
                            <li>Voyages & échanges culturels</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <div class="flex flex-col sm:flex-row gap-4 mt-6">
                <a href="{{ route('projets.index') }}"
                   class="block w-full sm:w-auto bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-lg font-medium shadow transition text-center">
                    Découvrir mes projets
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .photo-container {
            position: relative;
            overflow: hidden;
        }

        .protected-image {
            pointer-events: none;
            user-select: none;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            color: rgba(255, 255, 255, 0.25);
            font-size: clamp(1rem, 3vw, 2rem);
            font-weight: bold;
            white-space: nowrap;
            pointer-events: none;
            user-select: none;
        }
    </style>
@endpush
