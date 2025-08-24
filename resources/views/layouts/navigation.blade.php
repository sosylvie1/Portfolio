<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                
                <!-- Logo responsive -->
                <div class="shrink-0 flex items-center space-x-2">
                    <a href="{{ route('accueil') }}" class="flex items-center">
                        {{-- Logo S --}}
                        <img src="{{ asset('images/logo.png') }}" alt="Logo S"
                            title="Sylvie Seguinaud - Développeuse Web" class="h-16 w-auto">

                        {{-- Texte visible uniquement sur tablette/PC --}}
                        <span class="name-logo">Sylvie Seguinaud</span>


                    </a>
                </div>

{{-- Exemple : Google Analytics uniquement si accepté --}}
@isset($cookieConsent)
    @if($cookieConsent === 'accepted')
        {{-- Place ici ton script analytics --}}
        {{-- <script>/* GA / Matomo / etc. */</script> --}}
    @endif
@endisset




                <!-- Navigation Links (visibles à tous) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')">
                        Accueil
                    </x-nav-link>
                    <x-nav-link :href="route('a-propos')" :active="request()->routeIs('a-propos')">
                        À propos
                    </x-nav-link>
                    <x-nav-link :href="route('projets.index')" :active="request()->routeIs('projets.index')">
                        Projets
                    </x-nav-link>

                    <x-nav-link :href="route('cv')" :active="request()->routeIs('cv')">
                         CV
                    </x-nav-link>
                    <x-nav-link :href="route('contact.show')" :active="request()->routeIs('contact')">
                        Contact
                    </x-nav-link>

                </div>
            </div>


            <!-- Settings Dropdown (affiché si connecté) -->
            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            {{-- Admin ou Dashboard --}}
                            @if (Auth::user()->role === 1)
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    Tableau de bord
                                </x-dropdown-link>
                            @else
                                <x-dropdown-link :href="route('dashboard')">
                                    Mon espace
                                </x-dropdown-link>
                            @endif

                            <x-dropdown-link :href="route('profile.show')">
                                Profil
                            </x-dropdown-link>

                            <!-- Déconnexion -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Déconnexion
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            <!-- Liens invités -->
            @guest
                <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:underline">Connexion</a>
                    <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:underline">Inscription</a>
                </div>
            @endguest

            <!-- Hamburger (mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')">
                Accueil
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('a-propos')" :active="request()->routeIs('a-propos')">
                À propos
            </x-responsive-nav-link>
            <<x-nav-link :href="route('projets.index')" :active="request()->routeIs('projets.index')">
    Projets
</x-nav-link>

            <x-responsive-nav-link :href="route('contact.show')" :active="request()->routeIs('contact.show')">
                Contact
            </x-responsive-nav-link>
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    @if (Auth::user()->role === 1)
                        <x-responsive-nav-link :href="route('admin.dashboard')">
                           Tableau de bord
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link :href="route('dashboard')">
                            Mon espace
                        </x-responsive-nav-link>
                    @endif

                    <x-responsive-nav-link :href="route('profile.edit')">
                        Mon Profil
                    </x-responsive-nav-link>

                    <!-- Déconnexion -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Déconnexion
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth

        @guest
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="mt-3 space-y-1 px-4">
                    <a href="{{ route('login') }}" class="text-gray-700 block hover:underline">Connexion</a>
                    <a href="{{ route('register') }}" class="text-gray-700 block hover:underline">Inscription</a>
                </div>
            </div>
        @endguest
    </div>
</nav>
