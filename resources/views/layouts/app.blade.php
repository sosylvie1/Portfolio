<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- ✅ Preload image principale (LCP) -->
    <link rel="preload" as="image" href="{{ asset('images/sylvieA.webp') }}" type="image/webp" fetchpriority="high">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ✅ Balise robots SEO --}}
    <meta name="robots" content="@yield('robots', 'index, follow')">

    {{-- ✅ SEO de base --}}
    <meta name="description"
        content="Portfolio de Sylvie Seguinaud, développeuse web. Découvrez mes projets, mon parcours et mes compétences.">
    <meta name="author" content="Sylvie Seguinaud">

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
    @stack('head') {{-- ✅ Ici seront injectés les JSON-LD spécifiques aux pages --}}
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
                    /* ignore */
                }
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
    <script>
        function gallery(images) {
            return {
                images,
                index: 0,
                zoom: false,
                isPanning: false,
                startX: 0,
                startY: 0,
                offsetX: 0,
                offsetY: 0,

                // navigation
                next() {
                    this.index = (this.index + 1) % this.images.length;
                    this.resetZoom();
                },
                prev() {
                    this.index = (this.index - 1 + this.images.length) % this.images.length;
                    this.resetZoom();
                },
                go(i) {
                    this.index = i;
                    this.resetZoom();
                },
                close(dlg) {
                    dlg?.close();
                    this.resetZoom();
                },
                resetZoom() {
                    this.zoom = false;
                    this.offsetX = 0;
                    this.offsetY = 0;
                }
            }
        }
    </script>

    {{-- ✅ Bandeau RGPD --}}
    <x-cookie-banner />
</body>

</html>
