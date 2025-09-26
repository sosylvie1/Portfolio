<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Espace utilisateur')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50" x-data="{ open: false }" x-cloak>
    <div class="min-h-screen md:flex">

        {{-- Overlay (mobile) --}}
        <div class="fixed inset-0 bg-black/40 z-30 md:hidden" x-show="open" x-transition.opacity @click="open=false"
            aria-hidden="true">
        </div>

        {{-- Sidebar utilisateur --}}
        <aside
            class="fixed inset-y-0 left-0 z-40 w-72 bg-white border-r shadow-sm
             transform -translate-x-full md:translate-x-0 md:static md:w-64
             transition-transform duration-200 ease-in-out"
            :class="{ 'translate-x-0': open }" role="navigation" aria-label="Menu utilisateur">
            <div class="p-4 flex items-center justify-between border-b">
                <div class="font-bold">Espace Utilisateur</div>
                <button class="md:hidden p-2 rounded hover:bg-gray-100" @click="open=false"
                    aria-label="Fermer le menu">✖</button>
            </div>

            {{-- Liens utilisateur --}}
            <nav class="px-2 py-3 space-y-1">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100 transition"
                    @click="open=false">🏠 Tableau de bord</a>

                <a href="{{ route('user.cv') }}" class="block px-3 py-2 rounded hover:bg-gray-100 transition"
                    @click="open=false">📄 CV</a>
                {{-- //avoir --}}
                {{-- Messages --}}
                <div>
                    <a href="{{ route('messages.index') }}"
                        class="block px-3 py-2 rounded hover:bg-gray-100 transition font-semibold"
                        @click="open=false">✉️ Messages</a>

                    <div class="ml-6 mt-1 space-y-1 text-sm">
                        <a href="{{ route('messages.recus') }}"
                            class="block px-3 py-1 rounded hover:bg-gray-100 transition" @click="open=false">📥
                            Reçus</a>
                        <a href="{{ route('messages.envoyes') }}"
                            class="block px-3 py-1 rounded hover:bg-gray-100 transition" @click="open=false">📤
                            Envoyés</a>
                        <a href="{{ route('messages.supprimes') }}"
                            class="block px-3 py-1 rounded hover:bg-gray-100 transition" @click="open=false">🗑️
                            Supprimés</a>
                        <a href="{{ route('messages.create') }}"
                            class="block px-3 py-1 rounded hover:bg-gray-100 transition" @click="open=false">📝
                            Nouveau</a>
                    </div>
                </div>
                {{-- Profil --}}
                <div>
                    <a href="{{ route('profile.show') }}"
                        class="block px-3 py-2 rounded hover:bg-gray-100 transition font-semibold"
                        @click="open=false">👤 Profil</a>

                    <div class="ml-6 mt-1 space-y-1 text-sm">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-3 py-1 rounded hover:bg-gray-100 transition" @click="open=false">✏️
                            Modifier</a>
                    </div>
                </div>


                <div class="pt-2 mt-2 border-t">
                    <a href="{{ route('accueil') }}" class="block px-3 py-2 rounded hover:bg-gray-100 transition"
                        @click="open=false">🏠 Retour Accueil</a>
                </div>

                <div class="pt-2 mt-2 border-t">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-3 py-2 rounded text-red-600 hover:bg-red-50 transition"
                            @click="open=false">
                            🚪 Déconnexion
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        {{-- Contenu utilisateur --}}
        <main class="flex-1">
            {{-- Bouton burger (mobile) --}}
            <div class="md:hidden p-3">
                <button class="inline-flex items-center gap-2 px-3 py-2 rounded border bg-white hover:bg-gray-50"
                    @click="open=true" aria-label="Ouvrir le menu">
                    ☰ <span class="text-sm">Menu</span>
                </button>
            </div>

            @yield('content')
        </main>
    </div>

    {{-- SCRIPT INLINE SUPPRIMÉ : AlpineJS est déjà chargé via Vite --}}
    {{--
  <script src="https://unpkg.com/alpinejs" defer></script>
  --}}
</body>

</html>
