{{-- resources/views/layouts/navigation.blade.php --}}
<nav x-data="{ open: false, userMenu: false }" class="bg-white border-b border-gray-100" role="navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            {{-- Logo + Nom --}}
            <a href="{{ route('accueil') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.webp') }}" alt="Logo Sylvie Seguinaud" width="90" height="90"
                    class="h-12 w-auto" loading="lazy" decoding="async">
                <span class="text-lg sm:text-xl font-bold text-gray-800 tracking-tight">
                    Sylvie Seguinaud
                </span>
            </a>

            {{-- Liens navigation desktop --}}
            <ul class="hidden sm:flex space-x-8 ms-10">
                <li><x-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')">Accueil</x-nav-link></li>
                <li><x-nav-link :href="route('a-propos')" :active="request()->routeIs('a-propos')">À propos</x-nav-link></li>
                <li><x-nav-link :href="route('projets.index')" :active="request()->routeIs('projets.index')">Projets</x-nav-link></li>
                <li><x-nav-link :href="route('cv.public')" :active="request()->routeIs('cv.public')">CV</x-nav-link></li>
                <li><x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">Contact</x-nav-link></li>
            </ul>

            {{-- Menu utilisateur (desktop) --}}
            @auth
                <div class="hidden sm:flex sm:items-center relative">
                    <button @click="userMenu = !userMenu"
                        class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-pink-500 transition">
                        <span class="sr-only">Ouvrir le menu utilisateur</span>
                        {{-- Icône générique utilisateur --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                        </svg>
                    </button>

                    {{-- Dropdown utilisateur --}}
                    <div x-show="userMenu" @click.away="userMenu = false" x-transition
                        class="absolute right-0 top-full mt-2 w-56 bg-white rounded-md shadow-lg py-2 z-20">
                        <div class="px-4 py-2 border-b border-gray-200">
                            <p class="text-sm font-semibold text-gray-800">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                        <a href="{{ route('dashboard') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">🏠 Mon espace</a>
                        <a href="{{ route('profile.show') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">⚙️ Mon profil</a>
                        <a href="{{ route('cookies.manage') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">🍪 Cookies</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                🚪 Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="hidden sm:flex space-x-4">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Connexion</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Inscription</a>
                </div>
            @endauth

            {{-- Bouton burger mobile --}}
            <div class="sm:hidden flex items-center">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-800 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu mobile --}}
    <div class="sm:hidden" x-show="open" x-transition>
        <ul class="pt-2 pb-3 space-y-1">
            <li><x-responsive-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')">Accueil</x-responsive-nav-link></li>
            <li><x-responsive-nav-link :href="route('a-propos')" :active="request()->routeIs('a-propos')">À propos</x-responsive-nav-link></li>
            <li><x-responsive-nav-link :href="route('projets.index')" :active="request()->routeIs('projets.index')">Projets</x-responsive-nav-link></li>
            <li><x-responsive-nav-link :href="route('cv.public')" :active="request()->routeIs('cv.public')">CV</x-responsive-nav-link></li>
            <li><x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">Contact</x-responsive-nav-link></li>
        </ul>

        {{-- Zone utilisateur mobile --}}
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">

                    <div class="ml-3">
                        <div class="font-medium text-base text-gray-800">Bonjour {{ Auth::user()->name }}</div>
                        {{-- <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div> --}}
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')">🏠 Mon espace</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            🚪 Déconnexion
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200 space-y-1">
                <x-responsive-nav-link :href="route('login')">🔑 Connexion</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">📝 Inscription</x-responsive-nav-link>
            </div>
        @endauth
    </div>
</nav>
