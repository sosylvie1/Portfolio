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
                <li><x-nav-link :href="route('voyages.index')" :active="request()->routeIs('voyages.index')">Escales de vie</x-nav-link></li>
                <!-- Icône LinkedIn -->
                <li>
                    <a href="https://www.linkedin.com/in/sylvie-seguinaud" target="_blank"
                        class="text-gray-600 hover:text-blue-700 transition" aria-label="Profil LinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.76 0-5 2.24-5 5v14c0
                                     2.76 2.24 5 5 5h14c2.76 0 5-2.24
                                     5-5v-14c0-2.76-2.24-5-5-5zm-11
                                     19h-3v-10h3v10zm-1.5-11.25c-.97
                                     0-1.75-.79-1.75-1.75s.78-1.75
                                     1.75-1.75 1.75.79
                                     1.75 1.75-.78 1.75-1.75
                                     1.75zm13.5 11.25h-3v-5.6c0-1.34-.03-3.07-1.87-3.07-1.87
                                     0-2.16 1.46-2.16 2.96v5.71h-3v-10h2.88v1.37h.04c.4-.76
                                     1.38-1.56 2.85-1.56 3.05 0 3.62 2.01
                                     3.62 4.63v5.56z" />
                        </svg>
                    </a>
                </li>
            </ul>

            {{-- Menu utilisateur (desktop) --}}
            @auth
                <div class="hidden sm:flex sm:items-center relative space-x-3">
                    {{-- Bonjour Nom --}}
                    <span class="text-sm font-medium text-gray-700">
                        Bonjour, {{ Auth::user()->name }}
                    </span>

                    {{-- Bouton avatar utilisateur --}}
                    <button @click="userMenu = !userMenu"
                        class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-pink-500 transition">
                        <span class="sr-only">Ouvrir le menu utilisateur</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                        </svg>
                    </button>

                    {{-- Dropdown utilisateur --}}
                    <div x-show="userMenu" @click.away="userMenu = false" x-transition
                        class="absolute right-0 top-full mt-2 w-56 bg-white rounded-md shadow-lg py-2 z-20">
                        <!--<div class="px-4 py-2 border-b border-gray-200">-->
                        <!--    <p class="text-sm font-semibold text-gray-800">-->
                        <!--        {{ Auth::user()->name }}-->
                        <!--    </p>-->
                        <!--    <p class="text-xs text-gray-500">-->
                        <!--        {{ Auth::user()->email }}-->
                        <!--    </p>-->
                        <!--</div>-->

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
            <li><x-responsive-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')"
                    @click="open = false">Accueil</x-responsive-nav-link></li>
            <li><x-responsive-nav-link :href="route('a-propos')" :active="request()->routeIs('a-propos')" @click="open = false">À
                    propos</x-responsive-nav-link></li>
            <li><x-responsive-nav-link :href="route('projets.index')" :active="request()->routeIs('projets.index')"
                    @click="open = false">Projets</x-responsive-nav-link></li>
            <li><x-responsive-nav-link :href="route('cv.public')" :active="request()->routeIs('cv.public')"
                    @click="open = false">CV</x-responsive-nav-link></li>
            <li><x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')"
                    @click="open = false">Contact</x-responsive-nav-link></li>
            <li><x-responsive-nav-link :href="route('voyages.index')" :active="request()->routeIs('voyages.index')" @click="open = false">Escales de
                    vie</x-responsive-nav-link></li>

        </ul>

        {{-- Zone utilisateur mobile --}}
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <!--<div class="ml-3">-->
                    <div class="mt-3 space-y-1">
                        <div class="font-medium text-base text-gray-800">👋 Bonjour {{ Auth::user()->name }}</div>
                        <!--<div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>-->
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" @click="open = false">🏠 Mon espace</x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" @click="open = false"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            🚪 Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200 space-y-1">
                <x-responsive-nav-link :href="route('login')" @click="open = false">🔑 Connexion</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" @click="open = false">📝 Inscription</x-responsive-nav-link>
            </div>
        @endauth
    </div>
</nav>
