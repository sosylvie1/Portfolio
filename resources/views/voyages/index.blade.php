@extends('layouts.app')

@section('content')
    <!-- Section avec fond pastel -->
    <section class="bg-gradient-to-b from-pink-50 via-gray-50 to-pink-100 py-12">
        <div class="container mx-auto px-6 lg:px-16" x-data="{ open: false, images: [], current: 0 }">

            <!-- H1 unique pour la page -->
            <h1 class="text-3xl sm:text-4xl font-bold mb-6 text-center text-gray-800"
                style="font-size: 2rem; line-height: 2.5rem;">
                🌍 À la rencontre de pays et de ses habitants
            </h1>

            <p class="text-lg font-medium mb-10 text-center text-gray-700">
                Un minuscule extrait parmi des milliers de photos prises dans tous ces pays
            </p>

            <!-- Grille des voyages -->
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($voyages as $voyage)
                    @php
                        $photos = $voyage->photos ? json_decode($voyage->photos, true) : [];
                        $allImages = array_filter(array_merge([$voyage->photo], $photos));
                    @endphp

                    <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden flex flex-col">

                        <!-- Image principale -->
                        <figure class="photo-container h-56 w-full cursor-pointer relative" role="group"
                            aria-labelledby="caption-{{ $voyage->id }}"
                            @click='open = true; images = @json($allImages); current = 0'>

                            <picture>
                                <!-- Version WebP -->
                                <source
                                    srcset="{{ asset(pathinfo($voyage->photo, PATHINFO_DIRNAME) . '/' . pathinfo($voyage->photo, PATHINFO_FILENAME) . '.webp') }}"
                                    type="image/webp">

                                <!-- Fallback -->
                                <img src="{{ asset($voyage->photo) }}"
                                    alt="Voyage au {{ $voyage->pays }} en {{ $voyage->annee }}"
                                    class="protected-image w-full h-full object-cover"
                                    width="600" height="400"
                                    loading="lazy" decoding="async">
                            </picture>

                            <div class="watermark">© Sylvie Seguinaud</div>

                            <figcaption id="caption-{{ $voyage->id }}" class="sr-only">
                                {{ $voyage->pays }} ({{ $voyage->annee }})
                            </figcaption>
                        </figure>

                        <!-- Texte descriptif -->
                        <div class="p-4 flex-1">
                            <h2 class="text-xl font-semibold text-gray-800 mt-3">
                                {{ $voyage->pays }} ({{ $voyage->annee }})
                            </h2>
                            <p class="text-gray-600 text-sm mt-2">
                                {{ $voyage->description }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Lightbox -->
            <div x-show="open" x-transition
                class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 lightbox px-2"
                role="dialog" aria-modal="true" aria-label="Visionneuse de photos de voyages">

                <div class="relative w-full h-full flex items-center justify-center">

                    <!-- Bouton fermer -->
                    <button @click="open = false"
                        class="absolute top-4 right-4 bg-white rounded-full p-2 shadow hover:bg-gray-200 z-50"
                        aria-label="Fermer la visionneuse">✖
                    </button>

                    <!-- Bouton précédent -->
                    <button @click="if (current > 0) { current-- }"
                        class="absolute left-2 sm:left-6 top-1/2 transform -translate-y-1/2
                                   bg-white/80 text-black rounded-full p-3 shadow hover:bg-white
                                   disabled:opacity-40 disabled:cursor-not-allowed z-50"
                        :disabled="current === 0" aria-label="Photo précédente">⬅
                    </button>

                    <!-- Image principale -->
                    <figure class="photo-container max-h-[90vh] max-w-full flex items-center justify-center relative"
                        role="group" aria-labelledby="caption-lightbox">

                        <template x-if="images.length > 0">
                            <picture>
                                <!-- Version WebP -->
                                <source
                                    :srcset="images[current] ? '/' + images[current].replace(/\.(jpg|jpeg|png)$/i, '.webp') :
                                        '/images/placeholder.webp'"
                                    type="image/webp">

                                <!-- Fallback -->
                                <img :src="images[current] ? '/' + images[current] : '/images/placeholder.webp'"
                                    alt="Photo de voyage affichée dans la lightbox"
                                    class="protected-image max-h-[90vh] max-w-full object-contain rounded-lg shadow-lg"
                                    width="1200" height="800"
                                    loading="lazy" decoding="async">
                            </picture>
                        </template>

                        <div class="watermark">© Sylvie Seguinaud</div>

                        <figcaption id="caption-lightbox" class="sr-only">
                            Photo du voyage sélectionné
                        </figcaption>
                    </figure>

                    <!-- Bouton suivant -->
                    <button @click="if (current < images.length - 1) { current++ }"
                        class="absolute right-2 sm:right-6 top-1/2 transform -translate-y-1/2
                                   bg-white/80 text-black rounded-full p-3 shadow hover:bg-white
                                   disabled:opacity-40 disabled:cursor-not-allowed z-50"
                        :disabled="current === images.length - 1" aria-label="Photo suivante">➡
                    </button>
                </div>
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
            font-size: clamp(1rem, 4vw, 3rem);
            font-weight: bold;
            white-space: nowrap;
            pointer-events: none;
            user-select: none;
        }
        .lightbox button {
            z-index: 50;
        }
    </style>
@endpush
