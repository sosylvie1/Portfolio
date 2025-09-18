<nav x-data="{ open: false, userMenu: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo + Nom -->
            <a href="{{ route('accueil') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.webp') }}" alt="Logo personnel de Sylvie Seguinaud" width="90"
                    height="90" class="h-12 w-auto" loading="lazy" decoding="async">
                <span class="text-lg sm:text-xl font-bold text-gray-800 tracking-tight">
                    Sylvie Seguinaud
                </span>
            </a>

            <!-- Liens navigation (desktop) -->
            <ul class="hidden sm:flex space-x-8 ms-10">
                <li><x-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')">Accueil</x-nav-link></li>
                <li><x-nav-link :href="route('a-propos')" :active="request()->routeIs('a-propos')">À propos</x-nav-link></li>
                <li><x-nav-link :href="route('projets.index')" :active="request()->routeIs('projets.index')">Projets</x-nav-link></li>
                <li>
                    @auth
                        <x-nav-link :href="route('user.cv')" :active="request()->routeIs('user.cv')">CV</x-nav-link>
                    @else
                        <x-nav-link :href="route('cv.public')" :active="request()->routeIs('cv.public')">CV</x-nav-link>
                    @endauth
                </li>
                <li><x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">Contact</x-nav-link></li>
            </ul>

            <!-- Menu utilisateur (desktop) -->
            <div class="hidden sm:flex items-center space-x-4">
                @auth
                    <div class="relative" @click.away="userMenu = false">
                        <!-- Bouton avatar + flèche -->
                        <button @click="userMenu = !userMenu"
                            class="flex items-center space-x-2 text-sm text-gray-700 hover:text-pink-600 focus:outline-none">
                            <span>👤 {{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 transform transition-transform" :class="userMenu ? 'rotate-180' : ''"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Menu déroulant -->
                        <div x-show="userMenu" x-cloak x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                            <a href="{{ route('dashboard') }}" @click="userMenu = false"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">🏠 Mon espace</a>
                            <a href="{{ route('profile.edit') }}" @click="userMenu = false"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">⚙️ Mon profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" @click="userMenu = false"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    🚪 Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:underline">Connexion</a>
                    <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:underline">Inscription</a>
                @endauth
            </div>

            <!-- Hamburger (mobile) -->
            <button @click="open = true" class="sm:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100"
                aria-label="Ouvrir le menu de navigation" :aria-expanded="open.toString()">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Sidebar mobile -->
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex sm:hidden" role="dialog" aria-label="Menu mobile"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <div class="fixed inset-0 bg-black bg-opacity-50" @click="open = false"></div>

        <aside class="relative bg-white w-64 p-6 shadow-xl z-50 transform transition-transform duration-300"
            :class="open ? 'translate-x-0' : '-translate-x-full'">

            <button @click="open = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700"
                aria-label="Fermer le menu de navigation">
                <span aria-hidden="true">✖</span>
            </button>

            <ul class="mt-8 space-y-4">
                <li><a href="{{ route('accueil') }}" @click="open = false"
                        class="block text-gray-800 hover:text-pink-600">Accueil</a></li>
                <li><a href="{{ route('a-propos') }}" @click="open = false"
                        class="block text-gray-800 hover:text-pink-600">À propos</a></li>
                <li><a href="{{ route('projets.index') }}" @click="open = false"
                        class="block text-gray-800 hover:text-pink-600">Projets</a></li>
                <li>
                    @auth
                        <a href="{{ route('user.cv') }}" @click="open = false"
                            class="block text-gray-800 hover:text-pink-600">CV</a>
                    @else
                        <a href="{{ route('cv.public') }}" @click="open = false"
                            class="block text-gray-800 hover:text-pink-600">CV</a>
                    @endauth
                </li>
                <li><a href="{{ route('contact') }}" @click="open = false"
                        class="block text-gray-800 hover:text-pink-600">Contact</a></li>

                <hr class="my-4">

                @auth
                    <li><a href="{{ route('dashboard') }}" @click="open = false"
                            class="block text-gray-800 hover:text-pink-600">🏠 Mon espace</a></li>
                    <li><a href="{{ route('profile.edit') }}" @click="open = false"
                            class="block text-gray-800 hover:text-pink-600">⚙️ Mon profil</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" @click="open = false"
                                class="w-full text-left text-gray-800 hover:text-pink-600">🚪 Déconnexion</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" @click="open = false"
                            class="block text-gray-800 hover:text-pink-600">Connexion</a></li>
                    <li><a href="{{ route('register') }}" @click="open = false"
                            class="block text-gray-800 hover:text-pink-600">Inscription</a></li>
                @endauth
            </ul>
        </aside>
    </div>
</nav>
