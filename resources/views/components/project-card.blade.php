@props([
  'p' => [
    'title'       => '',
    'description' => '',
    'image'       => null,
    'tech'        => [],
    'github'      => null,
    'live'        => null,
    'case'        => null,
    'readme'      => null,
    'video'       => null,
    'video_webm'  => null,
    'figma'       => null,
  ],
])
@php
  $figmaImages = is_array($p['figma_images'] ?? null) ? $p['figma_images'] : [];
@endphp

@php
  $imagePath  = $p['image'] ?? null;
  $publicPath = $imagePath ? public_path($imagePath) : null;
  $src        = ($publicPath && file_exists($publicPath))
                  ? asset($imagePath)
                  : asset('images/placeholder.webp');
  $dateYm = $p['date'] ?? '';
  $title       = $p['title'] ?? '';
  $description = $p['description'] ?? '';
  $techs       = is_array($p['tech'] ?? null) ? $p['tech'] : [];
  $techString  = implode(' ', $techs);

  $github = $p['github'] ?? null;
  $live   = $p['live']   ?? null;
  $case   = $p['case']   ?? null;
  $readme = $p['readme'] ?? null;
  $figma  = $p['figma']  ?? null;

  $videoHref = null;
  if (!empty($p['video'])) {
      $videoHref = asset($p['video']);
  } elseif (!empty($p['video_webm'])) {
      $videoHref = asset($p['video_webm']);
  }
@endphp

<article
  class="group flex flex-col h-full bg-white/80 backdrop-blur border rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden"
  data-tech="{{ e($techString) }}"
>
  {{-- Image ratio fixe --}}
  <div class="aspect-[16/9] overflow-hidden bg-gray-100">
    <img
      src="{{ $src }}"
      alt="{{ $title ? 'Aperçu du projet ' . $title : 'Aperçu du projet' }}"
      loading="lazy"
      decoding="async"
      class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-[1.03]"
    />
  </div>

  {{-- Contenu --}}
  <div class="p-5 flex flex-col gap-4 flex-1">
    <header>
      
      <h2 class="text-lg sm:text-xl font-semibold leading-tight truncate">
        {{-- {{ $dateYm }} --}}

        {{ $title }}
      </h2>
      @if($description)
        <p class="mt-2 text-sm text-gray-600 line-clamp-2">
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
    <div class="mt-auto pt-2 flex flex-wrap gap-2">
      {{-- GitHub --}}
      @if(!empty($github))
        <a href="{{ $github }}" target="_blank" rel="noopener noreferrer"
           class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2a10 10 0 0 0-3.16 19.49c.5.09.68-.22.68-.49v-1.72c-2.78.6-3.37-1.19-3.37-1.19-.45-1.15-1.11-1.46-1.11-1.46-.91-.62.07-.61.07-.61 1 .07 1.52 1.03 1.52 1.03.9 1.53 2.36 1.09 2.94.83.09-.66.35-1.09.64-1.34-2.22-.25-4.56-1.11-4.56-4.93 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.65 0 0 .85-.27 2.78 1.02 1.1-.31 2.27-.47 3.44-.47s2.34.16 3.44.47c1.93-1.29 2.78-1.02 2.78-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.59 1.03 2.68 0 3.83-2.34 4.68-4.57 4.93.36.31.69.93.69 1.88v2.79c0 .27.18.59.69.49A10 10 0 0 0 12 2Z"/>
          </svg>
          Code
        </a>
      @endif

      {{-- Démo --}}
      @if(!empty($live))
        <a href="{{ $live }}" target="_blank" rel="noopener noreferrer"
           class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M14 3h7v7M21 3l-9 9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Démo
        </a>
      @endif

      {{-- Étude de cas --}}
      @if(!empty($case))
        <a href="{{ $case }}" class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M3 6h6l2 2h10v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Étude de cas
        </a>
      @endif

      {{-- README --}}
      @if(!empty($readme))
        <a href="{{ $readme }}" target="_blank" rel="noopener noreferrer"
           class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M14 2v6h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          README
        </a>
      @endif

      {{-- Vidéo --}}
      @if($videoHref)
        <a href="{{ $videoHref }}" target="_blank" rel="noopener noreferrer"
           class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M8 5v14l11-7z"/>
          </svg>
          Vidéo
        </a>
      @endif


      {{-- Figma maquette --}}
      @if(!empty($figmaImages))
  <button
    type="button"
    x-data
    @click="document.getElementById('gallery-{{ \Illuminate\Support\Str::slug($title ?: 'projet') }}').showModal()"
    class="inline-flex items-center gap-2 text-xs md:text-sm px-3 py-2 rounded-xl border hover:bg-gray-50"
    aria-label="Voir les maquettes de {{ $title }}"
  >
    {{-- Icône images --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M21 5H3a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2Zm-1 10-4.5-6-3.5 4.5L9 10 4 15h16Z"/></svg>
    Maquettes 
  </button>
@endif

    </div>
  </div>
</article>
@if(!empty($figmaImages))
  @php $galleryId = 'gallery-' . \Illuminate\Support\Str::slug($title ?: 'projet'); @endphp

  <dialog id="{{ $galleryId }}" class="p-0 rounded-2xl w-[95vw] max-w-5xl backdrop:backdrop-blur">
    <div x-data="gallery({{ json_encode(array_map('asset', $figmaImages)) }})"
         @keydown.window.escape="close($el)"
         class="flex flex-col">

      <!-- En-tête -->
      <div class="flex items-center justify-between px-4 py-2 border-b">
        <p class="font-semibold text-sm md:text-base">{{ $title }} — Maquettes (extraits)</p>
        <button @click="close($root.closest('dialog'))" class="px-2 py-1 rounded hover:bg-gray-100">Fermer</button>
      </div>

      <!-- Image principale -->
      <div class="relative bg-black">
        <div class="aspect-video w-full flex items-center justify-center">
          <img :src="images[index]" :alt="`Maquette ${index+1}`"
               class="max-h-[80vh] w-auto h-auto object-contain select-none" loading="lazy">
        </div>

        <!-- Prev / Next -->
        <button @click="prev" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full px-3 py-2">‹</button>
        <button @click="next" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full px-3 py-2">›</button>
      </div>

      <!-- Thumbnails -->
      <div class="p-3 border-t overflow-x-auto">
        <div class="flex gap-2">
          <template x-for="(src, i) in images" :key="i">
            <button @click="go(i)"
                    class="flex-shrink-0 border rounded-lg overflow-hidden focus:outline-none focus:ring-2 focus:ring-pink-400"
                    :class="i===index ? 'ring-2 ring-pink-400' : ''"
                    aria-label="Afficher la maquette" >
              <img :src="src" class="h-16 w-28 object-cover" loading="lazy" alt="">
            </button>
          </template>
        </div>
      </div>
    </div>
  </dialog>

  {{-- Alpine helper --}}
  <script>
    function gallery(images){
      return {
        images,
        index: 0,
        next(){ this.index = (this.index + 1) % this.images.length; },
        prev(){ this.index = (this.index - 1 + this.images.length) % this.images.length; },
        go(i){ this.index = i; },
        close(dlg){ dlg?.close(); },
      }
    }
  </script>
@endif

