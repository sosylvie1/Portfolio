@extends('layouts.app')
@section('body-class', 'accueil')
@section('content')
    <!-- Section d’introduction avec fond pastel -->
    <section class="bg-pink-50 py-16 px-4" aria-labelledby="section-intro">
        <div class="max-w-6xl mx-auto flex flex-col-reverse md:flex-row items-center gap-10">

            {{-- Texte d'accueil --}}
            <div class="md:w-1/2 text-center md:text-left space-y-6">

                <!-- ✅ H1 unique pour SEO -->
                <section class="bg-pink-50 py-16 px-4">
                    <h1 class="text-3xl sm:text-4xl font-bold mb-6">
                        Reconvertie, rechargée, redéployée.
                    </h1>


                    <!-- ✅ Phrase d’accroche mise en <p> pour SEO + accessibilité -->
                    <p class="text-pink-700 font-semibold text-lg italic mt-2 mb-4">
                        À 63 ans, j’ai relevé le défi du numérique. Et je suis prête à relever les vôtres.
                    </p>


                    <!-- ✅ Paragraphes bien structurés pour SEO -->
                    <div class="space-y-4 text-gray-700 text-base leading-relaxed">
                        <p>
                            Une reconversion engagée, née d'un parcours personnel riche. Après avoir vécu en France, aux
                            États-Unis, au Mexique, aux Émirats arabes unis et au Liban, j'ai développé une ouverture
                            d'esprit
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
                        </p>

                        <p>
                            Au fil des années, j’ai accumulé plus de 30 000 photos (merci Google Photos) — un véritable
                            trésor
                            de souvenirs — et il a été difficile d’en choisir quelques-unes seulement pour être
                            représentatives
                            de ce voyage de vie.
                            Vous y découvrirez mes projets, mes compétences, mais aussi les traces de ce cheminement
                            professionnel et personnel.
                        </p>
                    </div>

                    {{-- ✅ Lien vers les voyages avec texte alternatif pertinent --}}
                    <div class="flex flex-col items-center mt-6 text-center">
                        <section class="bg-pink-50 py-16 px-4">
                            <a href="{{ route('voyages.index') }}" aria-label="Découvrir mes voyages en images"
                                class="group">
                                <img src="{{ asset('images/googlemap.webp') }}" alt="Lien illustré vers la page Voyages"
                                    width="200" height="101"
                                    class="w-40 sm:w-52 rounded-lg shadow-lg transition-transform duration-300 group-hover:scale-105 group-hover:opacity-90"
                                    loading="lazy" decoding="async">

                                <p class="mt-2 text-sm font-medium text-pink-600 group-hover:text-pink-800">
                                    Embarquement immédiat
                                </p>
                        </section>



                        </a>
                    </div>

            </div>

            {{-- Image portrait sécurisée --}}
            <figure class="md:w-1/2 flex justify-center" role="group" aria-labelledby="caption-sylvie">
                <div class="photo-container w-full max-w-md relative">
                    <img src="{{ asset('images/sylvieA.webp') }}" alt="Portrait de Sylvie Seguinaud"
                        class="protected-image w-full max-h-[500px] rounded-xl shadow-xl object-cover mx-auto"
                        width="504" height="378" fetchpriority="high" decoding="async" loading="eager"
                        srcset="{{ asset('images/sylvieA-300.webp') }} 300w,
                    {{ asset('images/sylvieA.webp') }} 504w"
                        sizes="(max-width: 640px) 300px, 504px">

                    {{-- ✅ Filigrane --}}
                    {{-- <div class="watermark absolute bottom-2 right-2 text-xs text-gray-700 bg-white/50 px-2 py-1 rounded">
                        © Sylvie Seguinaud
                    </div> --}}
                    <div class="watermark absolute bottom-2 right-2 text-xs text-gray-700">
                        © Sylvie Seguinaud
                    </div>

                </div>

                <!-- ✅ Figcaption utile pour accessibilité -->
                <figcaption id="caption-sylvie" class="sr-only">
                    Portrait officiel de Sylvie Seguinaud
                </figcaption>
            </figure>


        </div>
    </section>
@endsection
{{-- pour relier la page d’accueil à moi --}}
{{-- @push('head')
    <script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => 'Accueil - Portfolio de Sylvie Seguinaud',
    'description' => "Bienvenue sur le portfolio de Sylvie Seguinaud, développeuse web. Découvrez mes projets, mes compétences et mon parcours international.",
    'url' => url('/'),
    'inLanguage' => 'fr',
    'isPartOf' => [
        '@type' => 'WebSite',
        'name' => 'Portfolio de Sylvie Seguinaud',
        'url' => url('/')
    ],
    'about' => [
        '@type' => 'Person',
        'name' => 'Sylvie Seguinaud',
        'jobTitle' => 'Développeuse Web & Web Mobile',
        'url' => url('/a-propos'),
        'sameAs' => [
            'https://www.linkedin.com/in/sylvie-seguinaud',
            'https://github.com/sosylvie1'
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush



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

        /* ✅ Filigrane centré et en diagonale */
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
@endpush --}}
