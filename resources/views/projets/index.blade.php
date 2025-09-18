@extends('layouts.app')

@section('body-class', 'projects-page') {{-- ✅ nécessaire pour activer JSON-LD & scripts via custom.js --}}

@section('title', 'Mes Projets - Portfolio de Sylvie Seguinaud')

@section('content')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" role="main" aria-labelledby="projects-title">
        
        <!-- Titre de page -->
        <header class="text-center mb-10">
            <h1 id="projects-title" class="text-3xl sm:text-4xl font-extrabold text-gray-800 mb-4 tracking-tight">
                Mes Projets
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Découvrez quelques <span class="font-semibold text-pink-500">projets choisis</span> parmi ceux réalisés
                pendant ma formation, pour un aperçu rapide de <span class="font-semibold text-pink-500">mon univers</span>.
            </p>
        </header>

        <!-- Section moments cultes -->
        <section x-data="{ open: true }"
            class="relative overflow-hidden rounded-2xl border border-pink-200/70 bg-white/70 backdrop-blur px-5 sm:px-8 py-6 mb-10"
            aria-labelledby="fun-moments-title">
            
            <header class="relative flex items-center justify-between gap-3 mb-6">
                <h2 id="fun-moments-title" class="text-lg sm:text-xl font-bold text-gray-800 flex items-center gap-2">
                    🎬 Moments cultes
                </h2>
                <button @click="open = !open"
                    class="text-xs sm:text-sm px-3 py-1.5 rounded-full border border-gray-300 hover:bg-gray-50 active:scale-95 transition"
                    :aria-expanded="open.toString()" x-text="open ? 'Masquer' : 'Afficher'"></button>
            </header>

            <div class="relative" x-show="open" x-transition>
                <div class="grid sm:grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Ici tes 3 articles Punchlines / Anecdotes / Auto-dérision -->
                    {{-- inchangé --}}
                </div>
            </div>
        </section>

        <!-- Grille projets -->
        <section id="projectsGrid" aria-labelledby="projects-list-title">
            <h2 id="projects-list-title" class="sr-only">Liste des projets</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-2 items-stretch">
                @foreach ($projects as $p)
                    <div class="h-full" data-date="{{ $p->date ?? '' }}">
                        <x-project-card :p="$p" />
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection

{{-- 🚫 JSON-LD inline supprimé (désormais injecté via custom.js) --}}
{{-- 🚫 Script timeline inline supprimé (désormais dans custom.js) --}}
