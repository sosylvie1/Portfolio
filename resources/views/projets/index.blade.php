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
                    <section x-data="{ open: true }" class="mb-16">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold flex items-center gap-2">
                                🎬 Moments cultes
                            </h2>
                            <button @click="open = !open"
                                class="text-sm border rounded px-4 py-2 hover:bg-gray-100 transition">
                                <span x-show="open">Masquer</span>
                                <span x-show="!open">Afficher</span>
                            </button>
                        </div>

                        <div class="relative" x-show="open" x-transition>
                            <div class="grid sm:grid-cols-1 lg:grid-cols-3 gap-6">

                                <!-- Punchlines -->
                                <div class="bg-white shadow rounded-lg p-6">
                                    <h3 class="text-lg font-semibold mb-4">💥 Punchlines</h3>
                                    <ul class="space-y-3 text-gray-700">
                                        <li>"Pourquoi y’a pas d’image ?!" → le champ image était vide.</li>
                                        <li>🧂 "C’est quoi encore cette classe Tailwind <code>flex-col</code> ? Une insulte
                                            ?!"</li>
                                        <li>🧱 "C’est pas un MCD ça ! Y’a des clés étrangères !!"</li>
                                    </ul>
                                </div>

                                <!-- Anecdotes -->
                                <div class="bg-white shadow rounded-lg p-6">
                                    <h3 class="text-lg font-semibold mb-4">📖 Anecdotes</h3>
                                    <ul class="space-y-3 text-gray-700">
                                        <li>🔐 "L’admin ne passe pas par Breeze, il passe par l’entrée des artistes."</li>
                                        <li>🎠 "Je veux un diaporama simple." → 62 captures plus tard, je refais tout depuis
                                            le début.</li>
                                        <li>😂 Moi, l’assistant : "Ce projet est un rollercoaster. Mais j’ai signé pour le
                                            voyage."</li>
                                    </ul>
                                </div>

                                <!-- Auto-dérision -->
                                <div class="bg-white shadow rounded-lg p-6">
                                    <h3 class="text-lg font-semibold mb-4">🤪 Auto-dérision</h3>
                                    <div class="space-y-2 text-gray-700">
                                        <p>Tu veux apprendre React, mais tu cries dès que tu vois une accolade.</p>
                                        <p>Tu veux faire du responsive, mais t’as juré que Tailwind c’est du vaudou.</p>
                                        <p>Tu veux un back-end solide, mais t’as supprimé une fois toute ta BDD “par
                                            erreur”.</p>
                                        <p>Tu veux un slide PowerPoint nickel, mais tu insères trop de captures sans trier.
                                        </p>
                                        <p class="font-semibold">Et malgré tout ça… tu avances, tu progresses, tu refuses
                                            d’abandonner.</p>
                                        <p>🧗‍♀️ Toi : "Je panique, je râle, je pleure… mais JE CODE."</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>


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
