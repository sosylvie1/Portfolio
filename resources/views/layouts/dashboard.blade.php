<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100 font-sans" x-data="{ sidebarOpen: false }">

<div class="flex min-h-screen">

    {{-- Sidebar mobile --}}
    <div class="fixed inset-0 flex z-40 lg:hidden" x-show="sidebarOpen" x-transition>
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="sidebarOpen = false"></div>

        <aside class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-200 text-gray-800">
            <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button @click="sidebarOpen = false" class="h-10 w-10 rounded-full bg-white">✕</button>
            </div>
            <div class="px-6 py-4 text-xl font-bold border-b border-gray-300">
                Tableau de bord
            </div>
            <nav class="flex-1 px-4 py-6 space-y-3">
                <a href="{{ route('contacts.received') }}" class="block px-3 py-2 rounded hover:bg-gray-300">📥 Messages reçus</a>
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded hover:bg-gray-300">👤 Mon profil</a>
                <a href="{{ route('cv.preview') }}" class="block px-3 py-2 rounded hover:bg-gray-300">📄 CV de Sylvie</a>
                <a href="{{ url('/') }}" class="block px-3 py-2 rounded hover:bg-gray-300">🏠 Retour à l'accueil</a>
            </nav>
            <div class="px-6 py-4 border-t border-gray-300 text-sm">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded bg-red-500 text-white hover:bg-red-600">
                        🚪 Déconnexion
                    </button>
                </form>
            </div>
        </aside>
    </div>

    {{-- Sidebar desktop --}}
    <aside class="hidden lg:flex lg:flex-col lg:w-64 bg-gray-200 text-gray-800">
        <div class="px-6 py-4 text-xl font-bold border-b border-gray-300">
            Tableau de bord
        </div>
        <nav class="flex-1 px-4 py-6 space-y-3">
            <a href="{{ route('contacts.received') }}" class="block px-3 py-2 rounded hover:bg-gray-300">📥 Messages reçus</a>
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded hover:bg-gray-300">👤 Mon profil</a>
            <a href="{{ route('cv.preview') }}" class="block px-3 py-2 rounded hover:bg-gray-300">📄 CV de Sylvie</a>
            <a href="{{ url('/') }}" class="block px-3 py-2 rounded hover:bg-gray-300">🏠 Retour à l'accueil</a>
        </nav>
        <div class="px-6 py-4 border-t border-gray-300 text-sm">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded bg-red-500 text-white hover:bg-red-600">
                    🚪 Déconnexion
                </button>
            </form>
            <div class="mt-3 text-xs text-gray-500">
                &copy; {{ date('Y') }} Portfolio
            </div>
        </div>
    </aside>

    {{-- Contenu principal --}}
    <div class="flex-1 flex flex-col">
        {{-- Topbar mobile --}}
        <div class="lg:hidden bg-gray-200 text-gray-800 p-4 flex items-center justify-between border-b border-gray-300">
            <button @click="sidebarOpen = true" class="text-gray-800">☰</button>
            <span class="font-bold">Dashboard</span>
        </div>

        <main class="flex-1 p-6">
            {{-- Flash messages --}}
            @if(session('success'))
                <div class="mb-4 p-4 rounded bg-green-100 border border-green-200 text-green-800">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 rounded bg-red-100 border border-red-200 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
