@props([
  // On passe un tableau associatif $p (projet)
  'p' => [
    'title'       => '',
    'description' => '',
    'image'       => null,      // ex: 'storage/projets/mon-image.webp' ou 'images/mon-image.webp'
    'tech'        => [],
    'github'      => null,
    'live'        => null,
    'case'        => null,
    'readme'      => null,
    'video'       => null,      // mp4
    'video_webm'  => null,      // webm (fallback si mp4 absent)
    'figma'       => null,
  ],
])

@php
  // Sécurisation minimale + fallback image
  $imagePath  = $p['image'] ?? null;
  $publicPath = $imagePath ? public_path($imagePath) : null;
  $src        = ($publicPath && file_exists($publicPath))
                  ? asset($imagePath)
                  : asset('images/placeholder.webp');

  $title       = $p['title']       ?? '';
  $description = $p['description'] ?? '';
  $techs       = is_array($p['tech'] ?? null) ? $p['tech'] : [];
  $techString  = implode(' ', $techs);

  // Liens externes (ne pas casser si vide)
  $github = $p['github'] ?? null;
  $live   = $p['live']   ?? null;
  $case   = $p['case']   ?? null;
  $readme = $p['readme'] ?? null;
  $figma  = $p['figma']  ?? null;

  // Vidéo : prend mp4 d'abord, sinon webm
  $videoHref = null;
  if (!empty($p['video'])) {
      $videoHref = asset($p['video']);
  } elseif (!empty($p['video_webm'])) {
      $videoHref = asset($p['video_webm']);
  }
@endphp

<article
  class="group bg-white/80 backdrop-blur border rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden"
  data-tech="{{ e($techString) }}"
>
  {{-- Image ratio 4:3 + micro-anim hover --}}
  <div class="aspect-[4:3] overflow-hidden bg-gray-100">
    <img
      src="{{ $src }}"
      alt="{{ $title ? 'Aperçu du projet ' . $title : 'Aperçu du projet' }}"
      loading="lazy"
      decoding="async"
      class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-[1.03]"
    />
  </div>

  {{-- Contenu --}}
  <div class="p-5 flex flex-col gap-4">
    <header>
      <h2 class="text-base sm:text-lg md:text-xl font-semibold leading-tight">
        {{ $title }}
      </h2>
      @if($description)
        <p class="mt-2 text-sm md:text-[15px] text-gray-600 line-clamp-2">
          {{ $description }}
        </p>
      @endif
    </header>

    {{-- Tech chips --}}
    @if(!empty($techs))
      <ul class="flex flex-wrap gap-2" role="list">
        @foreach ($techs as $tech)
          <li class="text-[11px] md:text-xs px-2 py-1 rounded-full bg-gray-100 border whitespace-nowrap">
            {{ $tech }}
          </li>
        @endforeach
      </ul>
    @endif

    {{-- Actions --}}
    <div class="mt-1 flex flex-wrap gap-2">
      @if(!empty($github))
        <a
          href="{{ $github }}"
          target="_blank"
          rel="noopener noreferrer"
          class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-400"
          aria-label="Voir le code sur GitHub pour {{ $title }}"
        >
          {{-- Icône Git minimaliste --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M12 2a10 10 0 0 0-3.16 19.49c.5.09.68-.22.68-.49v-1.72c-2.78.6-3.37-1.19-3.37-1.19-.45-1.15-1.11-1.46-1.11-1.46-.91-.62.07-.61.07-.61 1 .07 1.52 1.03 1.52 1.03.9 1.53 2.36 1.09 2.94.83.09-.66.35-1.09.64-1.34-2.22-.25-4.56-1.11-4.56-4.93 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.65 0 0 .85-.27 2.78 1.02 1.1-.31 2.27-.47 3.44-.47s2.34.16 3.44.47c1.93-1.29 2.78-1.02 2.78-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.59 1.03 2.68 0 3.83-2.34 4.68-4.57 4.93.36.31.69.93.69 1.88v2.79c0 .27.18.59.69.49A10 10 0 0 0 12 2Z"/>
          </svg>
          Code
        </a>
      @endif

      @if(!empty($live))
        <a
          href="{{ $live }}"
          target="_blank"
          rel="noopener noreferrer"
          class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-400"
          aria-label="Voir la démo en ligne de {{ $title }}"
        >
          {{-- Icône flèche externe --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
            <path d="M14 3h7v7M21 3l-9 9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Démo
        </a>
      @endif

      @if(!empty($case))
        <a
          href="{{ $case }}"
          class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-400"
          aria-label="Lire l’étude de cas du projet {{ $title }}"
        >
          {{-- Icône dossier --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
            <path d="M3 6h6l2 2h10v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Étude de cas
        </a>
      @endif

      @if(!empty($readme))
        <a
          href="{{ $readme }}"
          target="_blank"
          rel="noopener noreferrer"
          class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-400"
          aria-label="Lire le README du projet {{ $title }}"
        >
          {{-- Icône document --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
            <path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M14 2v6h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          README
        </a>
      @endif

      @if($videoHref)
        <a
          href="{{ $videoHref }}"
          target="_blank"
          rel="noopener noreferrer"
          class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-400"
          aria-label="Voir la vidéo de présentation de {{ $title }}"
        >
          {{-- Icône play --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M8 5v14l11-7z"/>
          </svg>
          Vidéo
        </a>
      @endif

      @if(!empty($figma))
        <a
          href="{{ $figma }}"
          target="_blank"
          rel="noopener noreferrer"
          class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-400"
          aria-label="Voir le prototype Figma de {{ $title }}"
        >
          {{-- Icône Figma simplifiée --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <circle cx="12" cy="4.5" r="2.5"/>
            <circle cx="12" cy="9.5" r="2.5"/>
            <circle cx="12" cy="14.5" r="2.5"/>
          </svg>
          Figma
        </a>
      @endif
    </div>
  </div>
</article>
