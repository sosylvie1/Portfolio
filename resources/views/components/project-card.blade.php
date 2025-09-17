@props([
    'p' => [
        'title' => '',
        'description' => '',
        'image' => null,
        'tech' => [],
        'github' => null,
        'live' => null,
        'case' => null,
        'readme' => null,
        'video' => null,
        'video_webm' => null,
        'figma' => null,
        'figma_images' => [],
    ],
])

@php
    if ($p instanceof \App\Models\Project) {
        $p = $p->toArray();
    }

    $figmaImages = $p['figma_images'] ?? [];
    $techs = $p['tech'] ?? [];

    $imagePath = $p['image'] ?? null;
    $publicPath = $imagePath ? public_path($imagePath) : null;
    $src = $publicPath && file_exists($publicPath) ? asset($imagePath) : asset('images/placeholder.webp');

    $title = $p['title'] ?? '';
    $description = $p['description'] ?? '';
    $techString = implode(' ', $techs);

    $github = $p['github'] ?? null;
    $live = $p['live'] ?? null;
    $readme = $p['readme'] ?? null;

    // ✅ Gestion vidéos (string ou array)
    $videos = [];
    if (!empty($p['video'])) {
        $videos[] = asset($p['video']);
    }
    if (!empty($p['video_webm'])) {
        $videos = is_array($p['video_webm'])
            ? array_map(fn($v) => asset($v), $p['video_webm'])
            : [asset($p['video_webm'])];
    }
@endphp

<article
    class="group flex flex-col h-full bg-white/80 backdrop-blur border rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden"
    data-tech="{{ e($techString) }}">

    {{-- Image principale --}}
    <img src="{{ $src }}" alt="{{ $title ? 'Aperçu du projet ' . $title : 'Aperçu du projet' }}" loading="lazy"
        decoding="async" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-[1.03]">

    {{-- Contenu --}}
    <div class="p-5 flex flex-col gap-4 flex-1">
        <header>
            <h2 class="text-lg sm:text-xl font-semibold leading-tight truncate">{{ $title }}</h2>
            @if ($description)
                <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $description }}</p>
            @endif
        </header>

        {{-- Technologies --}}
        @if (!empty($techs))
            <ul class="flex flex-wrap gap-2" role="list">
                @foreach ($techs as $tech)
                    <li class="text-[11px] md:text-xs px-2 py-1 rounded-full bg-gray-100 border whitespace-nowrap">
                        {{ $tech }}
                    </li>
                @endforeach
            </ul>
        @endif

        {{-- Actions --}}
        <div class="mt-auto pt-2 flex flex-wrap gap-2">
            @if ($github)
                <a href="{{ $github }}" target="_blank"
                    class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50">
                    Code
                </a>
            @endif
            @if ($live)
                <a href="{{ $live }}" target="_blank"
                    class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50">
                    Démo
                </a>
            @endif
            @if ($readme)
                <a href="{{ $readme }}" target="_blank"
                    class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50">
                    README
                </a>
            @endif

            {{-- Bouton Vidéos + Modale Alpine --}}
            @if (!empty($videos))
                <div x-data="{ openVideo: false, current: 0, vids: @js($videos) }">
                    <button type="button" @click="openVideo = true; current = 0"
                        class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50">
                        🎥 Voir la démo
                    </button>
<!-- ✅ Modale Vidéo Plein Écran -->
<div x-show="openVideo" x-transition
     class="fixed inset-0 bg-black/90 flex items-center justify-center z-50"
     style="display:none">
    <div class="relative w-[95%] md:w-[85%] lg:w-[75%]">
        <!-- Bouton fermer -->
        <button @click="
            document.querySelectorAll('#video-player').forEach(v => { v.pause(); v.currentTime = 0; });
            openVideo = false
        "
            class="absolute top-2 right-2 text-white hover:text-gray-300 text-4xl font-bold z-50">✖</button>

        <!-- Vidéo -->
        <video id="video-player" autoplay controls playsinline
               class="w-full max-h-[90vh] rounded-lg shadow-lg object-contain">
            <source src="{{ asset($videos[0] ?? '') }}" type="video/webm">
            Votre navigateur ne supporte pas la vidéo.
        </video>
    </div>
</div>




                </div>
            @endif

            {{-- Bouton Maquettes + Modale Alpine --}}
            @if (!empty($figmaImages))
                <div x-data="{ openGallery: false, index: 0, images: {{ json_encode(array_map(fn($img) => asset($img), $figmaImages)) }} }">
                    <button type="button" @click="openGallery = true"
                        class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50">
                        Maquettes
                    </button>

                    <!-- Modale Lightbox -->
                    <div x-show="openGallery" x-transition
                        class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 px-2"
                        style="display:none" role="dialog" aria-modal="true" aria-label="Visionneuse de maquettes">

                        <div class="relative w-full h-full flex items-center justify-center">
                            <!-- Bouton fermer -->
                            <button @click="openGallery = false"
                                class="absolute top-4 right-4 bg-white rounded-full p-2 shadow hover:bg-gray-200 z-50"
                                aria-label="Fermer la visionneuse">
                                ✖
                            </button>

                            <!-- Bouton précédent -->
                            <button @click="if (index > 0) { index-- }"
                                class="absolute left-2 sm:left-6 top-1/2 transform -translate-y-1/2
                                       bg-white/80 text-black rounded-full p-3 shadow hover:bg-white
                                       disabled:opacity-40 disabled:cursor-not-allowed z-50"
                                :disabled="index === 0" aria-label="Maquette précédente">
                                ⬅
                            </button>

                            <!-- Image principale -->
                            <figure class="max-h-[90vh] max-w-full flex items-center justify-center relative"
                                role="group" aria-labelledby="caption-lightbox">
                                <img :src="images[index]" :alt="'Maquette ' + (index + 1)"
                                    class="max-h-[90vh] max-w-full object-contain rounded-lg shadow-lg" loading="lazy">
                                <figcaption id="caption-lightbox" class="sr-only">
                                    Maquette du projet sélectionné
                                </figcaption>
                            </figure>

                            <!-- Bouton suivant -->
                            <button @click="if (index < images.length - 1) { index++ }"
                                class="absolute right-2 sm:right-6 top-1/2 transform -translate-y-1/2
                                       bg-white/80 text-black rounded-full p-3 shadow hover:bg-white
                                       disabled:opacity-40 disabled:cursor-not-allowed z-50"
                                :disabled="index === images.length - 1" aria-label="Maquette suivante">
                                ➡
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</article>
