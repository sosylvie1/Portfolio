@extends('layouts.app')

@section('content')
    <section class="bg-pink-50 py-16 px-4">
        <div class="max-w-6xl mx-auto flex flex-col-reverse md:flex-row items-center gap-10">

            {{-- Texte d'accueil --}}
            <div class="md:w-1/2 text-center md:text-left space-y-6">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight text-gray-800">
                    Reconvertie, rechargée, redéployée.
                </h1>

                <p class="text-pink-600 font-medium text-lg italic mt-2">
                    À 63 ans, j’ai relevé le défi du numérique. Et je suis prête à relever les vôtres.
                </p>

                <div class="space-y-4 text-gray-700 text-base leading-relaxed">
                    <p>
                        Une reconversion engagée, née d'un parcours personnel riche. Après avoir vécu en France, aux
                        États-Unis, au Mexique, aux Émirats arabes unis et au Liban, j'ai développé une ouverture d'esprit
                        et un regard pluriel sur les réalités humaines.
                    </p>

                    <p>
                        Le passage de la soixantaine et les bouleversements liés au Covid ont rendu le retour à l'emploi
                        difficile. J'ai alors choisi de me reconvertir dans le développement web à travers une formation
                        intensive de 13 mois.
                    </p>

                    <p>
                        Ce site n’est pas seulement un portfolio technique : c’est aussi le reflet d’un parcours de vie
                        riche en expériences internationales.
                        De Dubaï aux États-Unis, du Mexique à la Colombie, en passant par les îles Caïmans, j’ai voyagé,
                        vécu et travaillé à travers le monde.
                        Au fil des années, j’ai accumulé plus de 30 000 photos (merci Google photos) — un véritable trésor
                        de souvenirs — et il a été difficile d’en choisir quelques-unes seulement pour être représentatives
                        de ce voyage de vie.
                        Vous y découvrirez mes projets, mes compétences, mais aussi les traces de ce cheminement
                        professionnel et personnel.
                    </p>
                </div>

                {{-- Lien illustré vers la page voyages --}}
                <div class="flex justify-center mt-6">
                    <a href="{{ route('voyages.index') }}">
                        <img src="{{ asset('images/googlemap.png') }}" alt="Découvrir mes voyages"
                            class="w-40 sm:w-52 rounded-lg shadow-lg hover:opacity-90 transition">
                    </a>
                </div>
            </div>


            {{-- Image portrait sécurisée class protected-image --}}
            <figure class ="md:w-1/2 flex justify-center">
                <div class="photo-container w-full max-w-md">
                    <img src="{{ asset('images/sylvie1.jpg') }}" alt="Portrait Sylvie Seguinaud"
                        class="protected-image w-full max-h-[500px] rounded-xl shadow-xl object-contain sm:object-cover mx-auto "
                        loading="lazy">
                    <div class="watermark">© Sylvie Seguinaud</div>
                </div>
                <figcaption id="caption-sylvie" class="sr-only">
                    Portrait officiel de Sylvie Seguinaud
                </figcaption>
            </figure>

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
            /* bloque drag & drop */
            user-select: none;
            /* empêche sélection */
        }
    </style>
@endpush

{{-- /* ✅ Filigrane centré et en diagonale
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
    } */ --}}


{{-- @push('scripts')
<script>
    // ✅ Bloque le clic droit uniquement sur les images protégées
    document.addEventListener("contextmenu", function(e) {
        if (e.target.classList.contains('protected-image')) {
            e.preventDefault();
            alert("🚫 Copie interdite !");
        }
    });
</script>
@endpush --}}
