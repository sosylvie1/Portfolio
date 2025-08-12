@extends('layouts.app')

@section('content')
    <section class="bg-pink-50 py-16 px-4">
        <div class="max-w-5xl mx-auto space-y-10">

            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 text-center">
                En savoir plus sur moi
            </h1>

            {{-- Introduction personnelle --}}
            <div class="space-y-4 text-gray-800 text-lg leading-relaxed">
                <p><strong>Née le 15 mars 1962 à Cannes</strong> — pour les fervents d’astrologie, ça fait de moi une
                    "Poissons" assumée 🐟, intuitive, créative, et un brin rebelle.</p>
                <p>
                    Je m'appelle <strong>Sylvie Seguinaud</strong>, j'ai 63 ans, et je viens d'achever une reconversion vers
                    le développement web après une vie professionnelle et personnelle bien remplie. Mon parcours m'a menée
                    aux quatre coins du monde, de la France aux États-Unis, en passant par le Mexique, les Émirats arabes
                    unis et le Liban.
                </p>
                <p>
                    Cette diversité de cultures, d'expériences humaines et de défis m’a donné une capacité d’adaptation, une
                    curiosité constante, et un regard pluriel sur le monde. C’est avec cet état d’esprit que j’aborde
                    désormais l’univers du numérique.
                </p>
                <p>
                    Juin 2024 au 18 juillet 2015, j’ai suivi une formation intensive pour devenir <strong>Développeuse Web
                        et Web Mobile</strong>. Ce n’était pas un simple apprentissage technique : c’était un véritable défi
                    personnel. J’ai appris à coder, structurer, tester, documenter et créer des applications web modernes et
                    responsives.
                </p>

            </div>

            <div class="my-12 grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Card 1 --}}
                <div class="bg-white rounded-lg shadow-lg overflow-hidden text-center p-4">
                    <img src="{{ asset('images/formation-cannes.jpg') }}" alt="Début de la formation développeuse web"
                        class="mx-auto rounded-lg shadow max-w-full">
                    <p class="text-sm text-gray-600 mt-3">Groupe de la formation web 👩‍💻</p>
                </div>

                {{-- Card 2 --}}
                <div class="bg-white rounded-lg shadow-lg overflow-hidden text-center p-4">
                    <img src="{{ asset('images/formation.jpg') }}"
                        alt="le plus jeune et la plus agée du groupe de la formation"
                        class="mx-auto rounded-lg shadow max-w-xs sm:max-w-sm">


                    <p class="text-sm text-gray-600 mt-3">Le plus jeune (Hugo) et la plus agée (moi) du groupe de la
                        formation 😉</p>
                </div>
            </div>


            {{-- Citation inspirante --}}
            <blockquote class="mt-20 mb-12 border-l-4 border-pink-500 pl-6 italic text-pink-700 text-xl leading-relaxed">
                "Reconversion, pour moi, signifie ouverture, évolution, et liberté de créer autrement."
            </blockquote>

            <div class="bg-white border-l-4 border-gray-400 pl-6 pr-4 py-6 my-16 shadow-md rounded">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Ce que je recherche aujourd’hui</h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                    À 63 ans, je sais que certains employeurs peuvent être réticents. Mais moi, je suis toujours là,
                    disponible,
                    impliquée, curieuse, et plus que jamais utile.
                    <br><br>
                    Je cherche une structure qui a besoin de mes compétences : une <strong>association</strong>, une
                    <strong>mairie</strong>, une <strong>entreprise bienveillante</strong>, qui souhaite former ou
                    accompagner
                    des personnes en difficulté avec le numérique.
                    <br><br>
                    Je peux aussi être ce qu’on appelle un <strong>couteau suisse</strong> : je m’adapte, je m’implique, je
                    peux
                    aider à gérer des projets, du support, des dossiers, des outils web, de la relation humaine.
                    <br><br>
                    Ce que je propose : <em>un savoir-être</em>, de la polyvalence, et surtout l’envie de continuer à
                    transmettre, apprendre, et contribuer.
                </p>
            </div>


            {{-- Compétences principales --}}
            <div class="bg-pink-50 rounded-lg shadow p-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Compétences principales</h2>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    <li>Développement web : Laravel, Blade, HTML5, CSS3, JavaScript, PHP</li>
                    <li>Responsive design avec Tailwind CSS</li>
                    <li>Base de données : MySQL, Eloquent ORM, migrations</li>
                    <li>Git, GitHub, WordPress, Visual Studio Code</li>
                    <li>Outils IA : ChatGPT, GitHub Copilot, Google Gemini</li>
                    <li>Organisation, rigueur, autonomie, écoute, bienveillance</li>
                    <li>Créativité, gestion administrative, accompagnement humain</li>
                </ul>
            </div>
        </div>

        </div>
    </section>
@endsection
