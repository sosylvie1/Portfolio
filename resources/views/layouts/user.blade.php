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
        <main class="flex-1 p-6">
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
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ✅ Balise robots SEO -->
<meta name="robots" content="@yield('robots', 'index, follow')">


    {{-- ✅ SEO de base --}}
    <meta name="description"
        content="Portfolio de Sylvie Seguinaud, développeuse web. Découvrez mes projets, mon parcours et mes compétences.">
    <meta name="author" content="Sylvie Seguinaud">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    {{-- ✅ Open Graph --}}
    <meta property="og:title" content="@yield('title', 'Sylvie Seguinaud')" />
    <meta property="og:description"
        content="Portfolio de Sylvie Seguinaud, développeuse web. Découvrez mes projets, mon parcours et mes compétences." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/preview.jpg') }}" />
    <meta property="og:site_name" content="Portfolio Sylvie Seguinaud" />

    {{-- ✅ Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('title', 'Sylvie Seguinaud')" />
    <meta name="twitter:description"
        content="Portfolio de Sylvie Seguinaud, développeuse web. Découvrez mes projets, mon parcours et mes compétences." />
    <meta name="twitter:image" content="{{ asset('images/preview.jpg') }}" />


    {{-- ✅ JSON-LD : Person --}}
    <script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    'name' => 'Sylvie Seguinaud',
    'jobTitle' => 'Développeuse Web & Web Mobile',
    'description' => "Développeuse web passionnée, spécialisée en Laravel, Blade et Tailwind CSS, intuitive, créative et persévérante.",
    'url' => url('/a-propos'),
    'sameAs' => [
        'https://www.linkedin.com/in/sylvie-seguinaud',
        'https://github.com/sosylvie1'
    ]
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>

    {{-- ✅ JSON-LD : WebSite --}}
    <script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'url' => url('/'),
    'name' => 'Portfolio de Sylvie Seguinaud',
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => url('/recherche?q={search_term_string}'),
        'query-input' => 'required name=search_term_string'
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

    {{-- ✅ JSON-LD : Fil d’Ariane --}}
    <script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Accueil',
            'item' => url('/')
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => View::yieldContent('title', 'Page'),
            'item' => url()->current()
        ],
    ]
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>

    {{-- ✅ JSON-LD : Pages légales regroupées --}}
    <script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => 'Pages légales - Portfolio de Sylvie Seguinaud',
    'description' => 'Regroupement des pages légales du portfolio : CGU, Politique de confidentialité et Plan du site.',
    'url' => url('/'),
    'inLanguage' => 'fr',
    'hasPart' => [
        [
            '@type' => 'TermsOfService',
            'name' => 'Conditions Générales d’Utilisation',
            'url' => url('/cgu')
        ],
        [
            '@type' => 'PrivacyPolicy',
            'name' => 'Politique de confidentialité',
            'url' => url('/confidentialite')
        ],
        [
            '@type' => 'WebPage',
            'name' => 'Plan du site',
            'url' => url('/plan-du-site')
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>


    <title>@yield('title', 'Sylvie Seguinaud')</title>

    {{-- ✅ Styles et scripts via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
    @stack('head')  {{-- ✅ Ici seront injectés les JSON-LD spécifiques aux pages --}}
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="min-h-screen flex flex-col">

        {{-- ✅ Navigation principale --}}
        @include('layouts.navigation')

        {{-- ✅ Titre éventuel --}}
        @isset($header)
            <header class="bg-white shadow" role="banner">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- ✅ Contenu principal --}}
        <main id="main-content" class="flex-1 py-6 sm:py-10 px-2 sm:px-4" role="main">
            <div class="max-w-4xl mx-auto" aria-live="assertive">
                {{-- 🔥 Messages flash --}}
                @if (session('cookie_success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"
                        role="alert">
                        {{ session('cookie_success') }}
                    </div>
                @endif

                @if (session('cookie_error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        {{ session('cookie_error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"
                        role="alert">
                        {{ session('success') }}
                    </div>
                    <a href="{{ route('accueil') }}"
                        class="inline-block mt-2 px-4 py-2 bg-pink-700 text-white rounded-lg shadow hover:bg-pink-800 transition"
                        aria-label="Retourner à la page d’accueil">
                        ⬅ Retour à l'accueil
                    </a>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            @yield('content')
        </main>

        {{-- ✅ Footer global --}}
        <footer class="bg-gray-100 border-t mt-12" role="contentinfo">
            <div
                class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
                <p>&copy; {{ date('Y') }} Sylvie Seguinaud — Portfolio</p>
                <nav class="flex flex-col sm:flex-row gap-2 sm:gap-4 text-center sm:text-left"
                    aria-label="Liens légaux">
                    <a href="{{ route('cgu') }}" class="hover:underline mt-2 sm:mt-0"
                        aria-label="Conditions Générales d’Utilisation">CGU</a>
                    <a href="{{ route('confidentialite') }}" class="hover:underline mt-2 sm:mt-0"
                        aria-label="Politique de confidentialité">Confidentialité</a>
                    <a href="{{ route('plan-du-site') }}" class="hover:underline mt-2 sm:mt-0"
                        aria-label="Plan du site">Plan du site</a>
                </nav>
            </div>
        </footer>
    </div>
{{-- ✅ Scripts poussés depuis les vues --}}
    @stack('scripts')

    {{-- Alpine via CDN si non chargé dans app.js --}}
    <script src="https://unpkg.com/alpinejs" defer></script>

    {{-- Google Analytics (uniquement si cookies acceptés) --}}
    @php $cookieConsent = request()->cookie('cookie_consent'); @endphp
    @if ($cookieConsent === 'accepted')
        {{-- <script>/* Google Analytics */</script> --}}
    @endif

    {{-- SYNC AUTO : si connectée + cookie présent + DB vide -> enregistrement --}}
    @if (Auth::check() && $cookieConsent && !Auth::user()->cookie_consent_status)
        <script>
            (async () => {
                try {
                    await fetch('{{ route('cookie-consent.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            status: '{{ $cookieConsent }}'
                        }),
                        credentials: 'same-origin',
                    });
                } catch (e) {
                    /* ignore */ }
            })();
        </script>
    @endif

    

    {{-- ✅ Script global : protection images --}}
    <script>
        document.addEventListener("contextmenu", function(e) {
            if (e.target.classList.contains('protected-image')) {
                e.preventDefault();
                alert("🚫 Copie interdite !");
            }
        });
    </script>
    {{-- ✅ Alpine helper global pour les galeries --}}
    <script>
      function gallery(images){
        return {
          images,
          index: 0,
          next(){ this.index = (this.index + 1) % this.images.length },
          prev(){ this.index = (this.index - 1 + this.images.length) % this.images.length },
          go(i){ this.index = i },
          close(dlg){ dlg?.close() },
        }
      }
    </script>


    {{-- <x-cookie-banner /> --}}
</body>
</html>