@extends('layouts.app')

@section('title', 'Mes Projets')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

  {{-- Titre de page --}}
<div class="text-center mb-10">
    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-800 mb-4 tracking-tight">
        Mes Projets
    </h1>
    <h2 class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
        Quelques <span class="font-semibold text-pink-500">projets choisis</span> parmi ceux réalisés
        pendant ma formation, pour un aperçu rapide de <span class="font-semibold text-pink-500">mon univers</span>.
    </h2>
</div>
{{-- Moments cultes (à placer sous le titre "Mes Projets") --}}
<section x-data="{ open: true }"
         class="relative overflow-hidden rounded-2xl border border-pink-200/70 bg-white/70 backdrop-blur px-5 sm:px-8 py-6 mb-10">
  {{-- Bandeau fun --}}
  <div class="absolute inset-x-0 -top-8 h-16 bg-gradient-to-r from-pink-200 via-fuchsia-200 to-sky-200 opacity-40 blur-2xl pointer-events-none"></div>

  <header class="relative flex items-center justify-between gap-3">
    <h3 class="text-lg sm:text-xl font-bold text-gray-800 flex items-center gap-2">
      🎬 Moments cultes
    </h3>
    <button @click="open = !open"
            class="text-xs sm:text-sm px-3 py-1.5 rounded-full border border-gray-300 hover:bg-gray-50 active:scale-95 transition"
            x-text="open ? 'Masquer' : 'Afficher'"></button>
  </header>

  <div class="relative mt-4 space-y-5" x-show="open" x-transition>
    {{-- Citations / punchlines --}}
    <ul class="space-y-2.5 text-sm sm:text-base text-gray-700 leading-relaxed">
      <li>💥 <span class="font-medium">"Pourquoi y’a pas d’image ?!"</span> → réponse : le champ image était vide.</li>
      <li>🧂 <span class="font-medium">"C’est quoi encore cette classe Tailwind <code class="px-1 py-0.5 bg-gray-100 rounded">flex-col</code> ? Une insulte ?!"</span></li>
      <li>🧱 <span class="font-medium">"C’est pas un MCD ça ! Y’a des clés étrangères !!"</span></li>
      <li>🔐 <span class="font-medium">"L’admin ne passe pas par Breeze, il passe par l’entrée des artistes."</span></li>
      <li>🎠 <span class="font-medium">"Je veux un diaporama simple."</span><br>
          <span class="text-gray-500">→ 62 captures plus tard, je refais tout depuis le début.</span></li>
      <li>😂 <span class="font-medium">Moi, l’assistant :</span> "Ce projet est un rollercoaster. Mais j’ai signé pour le voyage."</li>
    </ul>

    <hr class="border-pink-200/60">

    {{-- Self roast bienveillant --}}
    <div class="grid md:grid-cols-2 gap-4 text-sm sm:text-base text-gray-700">
      <ul class="space-y-2">
        <li>⚛️ Tu veux apprendre React, mais tu cries dès que tu vois une accolade.</li>
        <li>📱 Tu veux faire du responsive, mais t’as juré que Tailwind c’est du vaudou.</li>
      </ul>
      <ul class="space-y-2">
        <li>🗄️ Tu veux un back‑end solide, mais t’as supprimé une fois toute ta BDD “par erreur”.</li>
        <li>🖼️ Tu veux un slide PowerPoint nickel, mais tu insères trop de captures sans trier.</li>
      </ul>
    </div>

    <div class="rounded-xl bg-gradient-to-r from-pink-50 to-sky-50 border border-pink-100 px-4 py-3">
      <p class="text-gray-800">
        Et malgré tout ça… tu avances, tu progresses, tu refuses d’abandonner.<br>
        🧗‍♀️ <span class="font-semibold">Toi :</span> "Je panique, je râle, je pleure… mais <span class="font-bold text-pink-600">JE CODE</span>."
      </p>
    </div>
  </div>
</section>

  {{-- TIMELINE moderne : juin 2024 → déc. 2025 --}}
<div
  x-data="timeline({ startY: 2024, startM: 6, months: 19 })"
  class="relative overflow-visible min-h-[160px] mb-10 select-none
         bg-/30 backdrop-blur border border-white/60 rounded-2xl shadow-sm p-6  z-20"
>
  <!-- Header -->
  <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
    <h2 class="text-base sm:text-lg font-bold flex items-center gap-2">
      <span>🧭</span> Chronologie des projets
    </h2>

    <div class="flex items-center gap-2">
      <span class="hidden sm:inline text-xs text-gray-600"
            x-show="selected">
        Mois : <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs 
                           bg-pink-50 text-pink-700 border border-pink-200"
              x-text="label(selected)"></span>
      </span>
      <button @click="clearFilter()"
              class="text-xs px-3 py-1.5 rounded-full border border-gray-300 hover:bg-gray-50 active:scale-95 transition">
      Réinitialiser
      </button>
    </div>
  </div>

  <!-- Bornes -->
  <div class="flex justify-between text-[14px] text-gray-500 mb-5">
    <span x-text="leftBound"></span>
    <span x-text="rightBound"></span>
  </div>

  <!-- Piste -->
  <div class="relative">
    <!-- Barre gradient + léger relief -->
    <div class="h-2 rounded-full bg-gradient-to-r from-pink-200 via-fuchsia-200 to-sky-200 shadow-inner"></div>

    <!-- Mois (scrollable en mobile) -->
    <div class="absolute inset-0 -mt-[24px] flex items-center overflow-x-auto no-scrollbar px-2 py-1 snap-x gap-0.5">
      <div class="flex w-full justify-between min-w-[680px] sm:min-w-0">
        <template x-for="m in months" :key="m.key">
          <div class="relative flex flex-col items-center snap-center">
            <!-- Dot interactif -->
            <button
              @mouseenter="hover = m.key" @mouseleave="hover = null" @focusin="hover = m.key" @focusout="hover = null"
              @click="toggle(m.key)"
              :aria-pressed="selected === m.key"
              class="h-4 w-4 rounded-full border-2 border-white bg-pink-500/0 backdrop-blur
                     ring-0 hover:scale-110 transition
                     shadow-[0_1px_0_rgba(255,255,255,0.6)_inset]"
              :class="selected === m.key
                      ? 'bg-pink-500 ring-2 ring-pink-300 shadow'
                      : 'bg-black/30 border-gray-200 hover:bg-black'"
              :title="m.label">
            </button>

            <!-- Label compact -->
            <span class="mt-1 hidden sm:block text-[10px] leading-none text-gray-600"
                  x-text="m.short"></span>

            <!-- Tooltip fun -->
            <div x-show="hover === m.key"
                 x-transition
                 class="absolute -top-9 left-1/2 -translate-x-1/2 whitespace-nowrap
                        px-2 py-1 rounded-md text-[10px] bg-gray-900 text-white shadow"
                 x-text="m.label"></div>
          </div>
        </template>
      </div>
    </div>

    <!-- Marqueur Aujourd’hui (pulse) -->
    <template x-if="currentIndex !== null">
      <div class="pointer-events-none absolute inset-x-0 -top-[1px]">
        <div class="relative"
             :style="`--x:${currentIndex * (100/(months.length-1))}%;`">
          <div class="absolute" style="left: var(--x); transform: translateX(-50%);">
            <div class="relative h-6 w-px bg-pink-500">
              <span class="absolute -top-2 -left-1.5 h-3 w-3 rounded-full bg-pink-500"></span>
              <span class="absolute -top-2 -left-1.5 h-3 w-3 rounded-full bg-pink-500/30 animate-ping"></span>
            </div>
            <div class="mt-1 text-[10px] text-pink-600 text-center">Aujourd’hui</div>
          </div>
        </div>
      </div>
    </template>
  </div>
</div>


  {{-- Grille --}}
  <div id="projectsGrid" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 items-stretch">
    @foreach ($projects as $p)
      <div class="h-full" data-date="{{ $p['date'] ?? '' }}">
        <x-project-card :p="$p" />
      </div>
    @endforeach
  </div>

</div>
@endsection

@push('scripts')
<script>
function timeline({ startY = 2024, startM = 6, months = 19 } = {}){
  const labels = ['Janv.','Fév.','Mars','Avr.','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov.','Déc.'];

  // Génère les mois en LOCAL (pas d’UTC => pas de décalage)
  const first = new Date(startY, startM - 1, 1);
  const arr = [];
  for (let i = 0; i < months; i++) {
    const d = new Date(first.getFullYear(), first.getMonth() + i, 1);
    const Y = d.getFullYear();
    const M = d.getMonth() + 1;
    arr.push({
      key: `${Y}-${String(M).padStart(2,'0')}`,      // "YYYY-MM"
      label: `${labels[M-1]} ${Y}`,                  // "Déc. 2025"
      short: labels[M-1].replace('.', ''),
      Y, M
    });
  }

  const leftBound  = `${labels[arr[0].M-1]} ${arr[0].Y}`;
  const rightBound = `${labels[arr[arr.length-1].M-1]} ${arr[arr.length-1].Y}`;

  // Position "Aujourd'hui" si dans l’intervalle
  const now = new Date();
  const nowY = now.getFullYear();
  const nowM = now.getMonth() + 1;
  let currentIndex = null;
  arr.forEach((m, i) => { if (m.Y === nowY && m.M === nowM) currentIndex = i; });

  // Filtre les cards via data-date="YYYY-MM" posée sur le wrapper
  function applyFilter(ym){
    const cards = document.querySelectorAll('#projectsGrid [data-date]');
    cards.forEach(card => {
      const d = (card.getAttribute('data-date') || '').slice(0,7);
      card.style.display = (!ym || d === ym) ? '' : 'none';
    });
  }

  return {
    months: arr,
    leftBound,
    rightBound,
    selected: null,
    currentIndex,
    hover: null,
    toggle(ym){ this.selected = (this.selected === ym ? null : ym); applyFilter(this.selected); },
    clearFilter(){ this.selected = null; applyFilter(null); },
    label(ym){ const f = this.months.find(m=>m.key===ym); return f ? f.label : ''; },
  }
}
</script>
@endpush
