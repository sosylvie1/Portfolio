<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace utilisateur')</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 font-sans" x-data="{ sidebarOpen: false, messagesOpen: false }">

    <div class="flex min-h-screen">

        <aside
            class="fixed inset-y-0 left-0 transform lg:relative lg:translate-x-0 
                   w-64 bg-gray-100 text-gray-800 shadow-lg lg:flex lg:flex-col 
                   transition-transform duration-300 ease-in-out"
            :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">

            {{-- Titre + bouton fermer (mobile uniquement) --}}
            <div class="flex justify-between items-center px-6 py-4 text-xl font-bold border-b border-gray-300">
                Mon espace
                <!-- Bouton croix (visible uniquement sur mobile) -->
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Menu --}}
            <nav class="flex-1 px-4 py-6 space-y-3">
                {{-- Section Messages avec sous-menu --}}
                <div>
                    <button @click="messagesOpen = !messagesOpen"
                        class="w-full text-left px-3 py-2 rounded hover:bg-gray-200 flex justify-between items-center">
                        <span>📨 Messages</span>
                        <span x-text="messagesOpen ? '−' : '+'"></span>
                    </button>

                    <div x-show="messagesOpen" x-cloak class="ml-4 mt-2 space-y-2">
                        <a href="{{ route('messages.recus') }}" class="block px-3 py-2 rounded hover:bg-gray-200">📥 Reçus</a>
                        <a href="{{ route('messages.envoyes') }}" class="block px-3 py-2 rounded hover:bg-gray-200">📤 Envoyés</a>
                        <a href="{{ route('messages.supprimes') }}" class="block px-3 py-2 rounded hover:bg-gray-200">🗑 Supprimés</a>
                    </div>
                </div>

                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded hover:bg-gray-200">👤 Mon profil</a>
                <a href="{{ route('user.cv') }}" class="block px-3 py-2 rounded hover:bg-gray-200">📄 CV de Sylvie</a>
                <a href="{{ url('/') }}" class="block px-3 py-2 rounded hover:bg-gray-300">🏠 Retour à l'accueil</a>
            </nav>

            {{-- Déconnexion --}}
            <div class="px-6 py-4 border-t border-gray-300 text-sm">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full px-3 py-2 rounded bg-red-500 text-white hover:bg-red-600">
                        🚪 Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        {{-- Contenu principal --}}
        <main class="flex-1 p-6 ml-0 lg:ml-64">
            {{-- Bouton burger mobile --}}
            <div class="lg:hidden mb-4">
                <button @click="sidebarOpen = !sidebarOpen" class="px-3 py-2 bg-gray-200 rounded shadow">
                    ☰ Menu
                </button>
            </div>

            {{-- 🔥 Nouveau système de messages flash --}}
            @if (session('cookie_success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('cookie_success') }}
                </div>
            @endif

            @if (session('cookie_error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('cookie_error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
                <a href="{{ route('accueil') }}"
           class="inline-block mt-2 px-4 py-2 bg-pink-500 text-white rounded-lg shadow hover:bg-pink-600 transition">
            ⬅ Retour à l'accueil
        </a>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            

            @yield('content')
        </main>
    </div>

    <x-cookie-banner />
</body>
</html>
