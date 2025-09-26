@extends('layouts.app')

@section('body-class', 'voyages-page') {{-- ✅ nécessaire pour activer JSON-LD via custom.js --}}

@section('content')
    <!-- Section avec fond pastel -->
    <section class="bg-gradient-to-b from-pink-50 via-gray-50 to-pink-100 py-12">
        <div class="container mx-auto px-6 lg:px-16" x-data="{ open: false, images: [], current: 0 }">

            <!-- H1 unique -->
            <h1 class="text-3xl sm:text-4xl font-bold mb-6 text-center text-gray-800">
                🌍 À la rencontre de pays et de ses habitants
            </h1>

            <p class="text-lg font-medium mb-10 text-center text-gray-700">
                Un minuscule extrait parmi des milliers de photos prises dans tous ces pays
            </p>

            <!-- Grille des voyages -->
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($voyages as $voyage)
                    @php
                        // On construit la liste des images (photo principale + toutes les autres liées)
                        $allImages = [['src' => $voyage->photo, 'caption' => $voyage->description]];

                        foreach ($voyage->photos()->get() as $photo) {
                            $allImages[] = ['src' => $photo->src, 'caption' => $photo->caption];
                        }
                    @endphp

                    <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden flex flex-col">
                        <!-- Image principale -->
                        <figure class="photo-container h-56 w-full cursor-pointer relative"
                            aria-labelledby="caption-{{ $voyage->id }}"
                            @click='open = true; images = @json($allImages); current = 0'>
                            <picture>
                                <source
                                    srcset="{{ asset(pathinfo($voyage->photo, PATHINFO_DIRNAME) . '/' . pathinfo($voyage->photo, PATHINFO_FILENAME) . '.webp') }}"
                                    type="image/webp">
                                <img src="{{ asset($voyage->photo) }}"
                                    alt="Voyage au {{ $voyage->pays }} en {{ $voyage->annee }}"
                                    class="protected-image w-full h-full object-cover" width="600" height="400"
                                    loading="lazy" decoding="async">
                            </picture>
                            <div class="watermark">© Sylvie Seguinaud</div>
                            <figcaption id="caption-{{ $voyage->id }}" class="sr-only">
                                {{ $voyage->pays }} ({{ $voyage->annee }})
                            </figcaption>
                        </figure>

                        <!-- Texte -->
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
                        aria-label="Fermer la visionneuse">✖</button>

                    <!-- Bouton précédent -->
                    <button @click="if (current > 0) { current-- }"
                        class="absolute left-2 sm:left-6 top-1/2 transform -translate-y-1/2
                                   bg-white/80 text-black rounded-full p-3 shadow hover:bg-white
                                   disabled:opacity-40 disabled:cursor-not-allowed z-50"
                        :disabled="current === 0" aria-label="Photo précédente">⬅</button>


                    <!-- Image principale -->
                    <!-- ✅ Image + légende -->
                    <!-- ✅ Image + légende responsive -->
                    <figure class="photo-container flex flex-col items-center justify-center relative w-full">
                        <template x-if="images.length > 0">
                            <picture>
                                <source :srcset="images[current].src.replace(/\.(jpg|jpeg|png)$/i, '.webp')"
                                    type="image/webp">
                                <img :src="'/' + images[current].src" :alt="images[current].caption"
                                    class="protected-image max-h-[80vh] sm:max-h-[85vh] md:max-h-[90vh] 
                        w-auto max-w-full object-contain rounded-lg shadow-lg"
                                    loading="lazy" decoding="async">
                            </picture>
                        </template>

                        <!-- ✅ Légende toujours lisible -->
                        <figcaption
                            class="text-white bg-black/70 rounded px-3 py-2 mt-3 
                       text-center text-sm sm:text-base md:text-lg font-medium leading-snug w-full max-w-4xl">
                            <span x-text="images[current]?.caption"></span>
                        </figcaption>
                    </figure>




                    <div class="watermark">© Sylvie Seguinaud</div>
                    </figure>


                    <!-- Bouton suivant -->
                    <button @click="if (current < images.length - 1) { current++ }"
                        class="absolute right-2 sm:right-6 top-1/2 transform -translate-y-1/2
                                   bg-white/80 text-black rounded-full p-3 shadow hover:bg-white
                                   disabled:opacity-40 disabled:cursor-not-allowed z-50"
                        :disabled="current === images.length - 1" aria-label="Photo suivante">➡</button>
                </div>
            </div>
        </div>
    </section>
@endsection


{{-- 🚫 CSS inline supprimé → déplacé dans app.css --}}
