@extends('layouts.app')

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

            <div
                class="absolute inset-x-0 -top-8 h-16 bg-gradient-to-r from-pink-200 via-fuchsia-200 to-sky-200 opacity-40 blur-2xl pointer-events-none">
            </div>

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

                    <!-- Punchlines -->
                    <article class="rounded-xl border border-pink-200 bg-white shadow-sm p-6"
                        aria-labelledby="punchlines-title">
                        <h3 id="punchlines-title" class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            🎤 Punchlines
                        </h3>
                        <ul class="space-y-3 text-sm sm:text-base text-gray-700 leading-relaxed">
                            <li>💥 <span class="font-semibold">"Pourquoi y’a pas d’image ?!"</span> → le champ image était
                                vide.</li>
                            <li>🧂 <span class="font-semibold">"C’est quoi encore cette classe Tailwind
                                    <code class="px-1 py-0.5 bg-gray-100 rounded text-xs">flex-col</code> ? Une insulte
                                    ?!"</span></li>
                            <li>🧱 <span class="font-semibold">"C’est pas un MCD ça ! Y’a des clés étrangères !!"</span>
                            </li>
                            <li>🔐 <span class="font-semibold">"L’admin ne passe pas par Breeze, il passe par l’entrée des
                                    artistes."</span></li>
                        </ul>
                    </article>

                    <!-- Anecdotes -->
                    <article class="rounded-xl border border-fuchsia-200 bg-white shadow-sm p-6"
                        aria-labelledby="anecdotes-title">
                        <h3 id="anecdotes-title" class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            🎠 Anecdotes
                        </h3>
                        <ul class="space-y-3 text-sm sm:text-base text-gray-700 leading-relaxed">
                            <li>🎠 <span class="font-semibold">"Je veux un diaporama simple."</span><br>
                                <span class="text-gray-500 text-sm">→ 62 captures plus tard, on recommence depuis le
                                    début…</span>
                            </li>
                            <li>😂 <span class="font-semibold">Moi, l’assistant :</span> "Ce projet est un rollercoaster.
                                Mais j’ai signé pour le voyage."</li>
                        </ul>
                    </article>

                    <!-- Auto-dérision -->
                    <article class="rounded-xl border border-sky-200 bg-white shadow-sm p-6"
                        aria-labelledby="self-mockery-title">
                        <h3 id="self-mockery-title" class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            🤹 Auto-dérision
                        </h3>
                        <div class="grid sm:grid-cols-1 gap-3 text-sm sm:text-base text-gray-700">
                            <ul class="space-y-2">
                                <li>⚛️ Tu veux apprendre React, mais tu cries dès que tu vois une accolade.</li>
                                <li>📱 Tu veux faire du responsive, mais tu dis encore que Tailwind c’est de la sorcellerie.
                                </li>
                            </ul>
                            <ul class="space-y-2">
                                <li>🗄️ Tu veux un back-end solide, mais tu as déjà supprimé ta BDD “par erreur”.</li>
                                <li>🖼️ Tu veux un PowerPoint parfait, mais tu insères toutes les captures sans trier.</li>
                            </ul>
                        </div>
                        <p
                            class="rounded-xl bg-gradient-to-r from-pink-50 to-sky-50 border border-pink-100 px-4 py-3 mt-4 text-gray-800 text-center">
                            ✨ Et malgré tout ça… tu avances, tu progresses, tu refuses d’abandonner.<br>
                            🧗‍♀️ <span class="font-semibold">Toi :</span> "Je panique, je râle, je pleure… mais
                            <span class="font-bold text-pink-600">JE CODE</span>."
                        </p>
                    </article>

                </div>
            </div>
        </section>


        {{-- <!-- ✅ Section Projets aboutis -->
        <section id="projets-aboutis" class="mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-center mb-10 text-gray-800">
                🔍
            </h2>
            <div x-data="timeline({ startY: 2024, startM: 6, months: 19 })" class="relative select-none">
                <!-- Ligne rose -->
                <div class="absolute top-1/2 left-0 right-0 h-1 bg-pink-400 rounded-full transform -translate-y-1/2"></div>

                <!-- Liste des mois -->
                <div class="relative flex justify-between items-center">
                    <template x-for="(m, i) in months" :key="m.key">
                        <div class="flex flex-col items-center w-full cursor-pointer" @click="toggle(m.key)">
                            <!-- Bulle -->
                            <div class="w-16 h-16 flex items-center justify-center rounded-full border-2 text-xs sm:text-sm font-semibold transition"
                                :class="selected === m.key ?
                                    'bg-pink-500 text-white border-pink-600 shadow-lg scale-105' :
                                    'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'">
                                <span x-text="m.short"></span>
                            </div>
                            
                            {{-- <!-- Label sous la bulle -->
          <span class="mt-2 text-[10px] sm:text-xs text-gray-600" x-text="m.label"></span> --}}
                        {{-- </div>
                    </template>
                </div>

                <!-- Bouton reset -->
                <div class="mt-6 text-center">
                    <button @click="clearFilter"
                        class="px-4 py-2 text-xs sm:text-sm bg-gray-100 border rounded-lg hover:bg-gray-200 transition">
                        🔄 Réinitialiser
                    </button>
                </div>
            </div>
        </section> --}} 


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

@push('head')
    <script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'CollectionPage',
    'name' => 'Mes Projets - Portfolio de Sylvie Seguinaud',
    'description' => "Découvrez une sélection de projets réalisés par Sylvie Seguinaud pendant sa formation en développement web.",
    'url' => url('/projets'),
    'inLanguage' => 'fr',
    'isPartOf' => [
        '@type' => 'WebSite',
        'name' => 'Portfolio de Sylvie Seguinaud',
        'url' => url('/')
    ],
    'mainEntity' => [
        '@type' => 'ItemList',
        'itemListElement' => $projects->map(function ($p, $index) {
            return [
                '@type' => 'CreativeWork',
                'position' => $index + 1,
                'name' => $p->title ?? 'Projet sans titre',
                'description' => $p->description ?? 'Projet issu du portfolio de Sylvie Seguinaud',
                'image' => $p->image ? asset($p->image) : asset('images/placeholder.webp'),
                'dateCreated' => $p->date ?? null,
                'inLanguage' => 'fr'
            ];
        })->values()->all()
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@push('scripts')
    <script>
        function timeline({
            startY = 2024,
            startM = 6,
            months = 19
        } = {}) {
            const labels = ['Janv.', 'Fév.', 'Mars', 'Avr.', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.',
                'Déc.'];

            const first = new Date(startY, startM - 1, 1);
            const arr = [];
            for (let i = 0; i < months; i++) {
                const d = new Date(first.getFullYear(), first.getMonth() + i, 1);
                const Y = d.getFullYear();
                const M = d.getMonth() + 1;
                arr.push({
                    key: `${Y}-${String(M).padStart(2,'0')}`,
                    label: `${labels[M-1]} ${Y}`,
                    short: labels[M - 1].replace('.', ''),
                    Y,
                    M
                });
            }

            const leftBound = `${labels[arr[0].M-1]} ${arr[0].Y}`;
            const rightBound = `${labels[arr[arr.length-1].M-1]} ${arr[arr.length-1].Y}`;

            const now = new Date();
            const nowY = now.getFullYear();
            const nowM = now.getMonth() + 1;
            let currentIndex = null;
            arr.forEach((m, i) => {
                if (m.Y === nowY && m.M === nowM) currentIndex = i;
            });

            function applyFilter(ym) {
                const cards = document.querySelectorAll('#projectsGrid [data-date]');
                cards.forEach(card => {
                    const d = (card.getAttribute('data-date') || '').slice(0, 7);
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
                toggle(ym) {
                    this.selected = (this.selected === ym ? null : ym);
                    applyFilter(this.selected);
                },
                clearFilter() {
                    this.selected = null;
                    applyFilter(null);
                },
                label(ym) {
                    const f = this.months.find(m => m.key === ym);
                    return f ? f.label : '';
                },
            }
        }
    </script>
@endpush
