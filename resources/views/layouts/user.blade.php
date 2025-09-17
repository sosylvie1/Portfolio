<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace utilisateur - Portfolio de Sylvie Seguinaud')</title>

    {{-- SEO --}}
    <meta name="description" content="@yield('meta_description', 'Espace utilisateur pour gérer vos messages et votre profil sur le portfolio de Sylvie Seguinaud.')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="noindex, follow">

    {{-- OpenGraph --}}
    <meta property="og:title" content="@yield('title', 'Espace utilisateur - Sylvie Seguinaud')" />
    <meta property="og:description" content="Gérez vos messages et votre profil utilisateur sur le portfolio de Sylvie Seguinaud." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/preview.jpg') }}" />

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('title', 'Sylvie Seguinaud')" />
    <meta name="twitter:description" content="Portfolio et espace utilisateur de Sylvie Seguinaud." />
    <meta name="twitter:image" content="{{ asset('images/preview.jpg') }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 font-sans antialiased" 
      x-data="{ sidebarOpen: false, messagesOpen: false }">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 transform lg:relative lg:translate-x-0 
                   w-64 bg-gray-100 text-gray-800 shadow-lg lg:flex lg:flex-col 
                   transition-transform duration-300 ease-in-out"
         :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
         role="complementary" aria-label="Menu utilisateur">

        <!-- Header sidebar -->
        <div class="flex justify-between items-center px-6 py-4 text-lg font-bold border-b border-gray-300">
            <span aria-label="Nom de l’utilisateur connecté">👤 {{ Auth::user()->name ?? 'Utilisateur' }}</span>
            <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700" aria-label="Fermer le menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Menu principal -->
        <nav class="flex-1 px-4 py-6 space-y-3" role="navigation" aria-label="Navigation utilisateur">

            <!-- Section messages -->
            <div>
                <button @click="messagesOpen = !messagesOpen"
                        class="w-full text-left px-3 py-2 rounded hover:bg-gray-200 flex justify-between items-center"
                        :aria-expanded="messagesOpen.toString()" aria-controls="submenu-messages">
                    <span>📨 Messages</span>
                    <span x-text="messagesOpen ? '−' : '+'"></span>
                </button>

                <div id="submenu-messages" x-show="messagesOpen" x-cloak class="ml-4 mt-2 space-y-2">
                    <a href="{{ route('messages.recus') }}" class="block px-3 py-2 rounded hover:bg-gray-200">📥 Reçus</a>
                    <a href="{{ route('messages.envoyes') }}" class="block px-3 py-2 rounded hover:bg-gray-200">📤 Envoyés</a>
                    <a href="{{ route('messages.supprimes') }}" class="block px-3 py-2 rounded hover:bg-gray-200">🗑 Supprimés</a>
                    <a href="{{ route('messages.create') }}" class="block px-3 py-2 rounded hover:bg-gray-200">✉️ Nouveau message</a>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded hover:bg-gray-200">⚙ Mon profil</a>
            <a href="{{ route('user.cv') }}" class="block px-3 py-2 rounded hover:bg-gray-200">📄 Mon CV</a>
            <a href="{{ url('/') }}" class="block px-3 py-2 rounded hover:bg-gray-200">🏠 Accueil public</a>
        </nav>

        <!-- Déconnexion -->
        <div class="px-6 py-4 border-t border-gray-300 text-sm">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-3 py-2 rounded bg-red-500 text-white hover:bg-red-600">
                    🚪 Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <!-- Contenu principal -->
    <main class="flex-1 p-6" role="main" id="main-content">

        <!-- Bouton burger mobile -->
        <div class="lg:hidden mb-4">
            <button @click="sidebarOpen = !sidebarOpen" class="px-3 py-2 bg-gray-200 rounded shadow"
                    aria-controls="main-sidebar" aria-expanded="false" aria-label="Ouvrir le menu">
                ☰ Menu
            </button>
        </div>

        <!-- Flash messages -->
        <div aria-live="polite">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <!-- Contenu dynamique -->
        @yield('content')

        <!-- Footer -->
        <footer class="bg-gray-100 border-t mt-12 text-sm text-gray-600 py-4 text-center" role="contentinfo">
            <p>&copy; {{ date('Y') }} Sylvie Seguinaud — Portfolio</p>
            <nav class="mt-2 flex justify-center gap-4" aria-label="Liens légaux">
                <a href="{{ route('cgu') }}" class="hover:underline">CGU</a>
                <a href="{{ route('confidentialite') }}" class="hover:underline">Confidentialité</a>
                <a href="{{ route('plan-du-site') }}" class="hover:underline">Plan du site</a>
            </nav>
        </footer>
    </main>
</div>
</body>
</html>
