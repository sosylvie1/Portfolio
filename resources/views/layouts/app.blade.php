<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ✅ SEO : description --}}
    <meta name="description"
        content="Portfolio de Sylvie Seguinaud, développeuse web. Découvrez mes projets, mon parcours et mes compétences.">

    {{-- ✅ SEO : Open Graph --}}
    <meta property="og:title" content="@yield('title', 'Sylvie Seguinaud')" />
    <meta property="og:description"
        content="Portfolio de Sylvie Seguinaud, développeuse web. Découvrez mes projets, mon parcours et mes compétences." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/preview.jpg') }}" />

    {{-- ✅ SEO : Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('title', 'Sylvie Seguinaud')" />
    <meta name="twitter:description"
        content="Portfolio de Sylvie Seguinaud, développeuse web. Découvrez mes projets, mon parcours et mes compétences." />
    <meta name="twitter:image" content="{{ asset('images/preview.jpg') }}" />

    {{-- ✅ Titre dynamique --}}
    <title>@yield('title', 'Sylvie Seguinaud')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Styles & app scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ✅ Styles poussés depuis les vues --}}
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="min-h-screen flex flex-col">

        {{-- Navigation --}}
        @include('layouts.navigation')

        {{-- Titre éventuel --}}
        @isset($header)
            <header class="bg-white shadow" role="banner">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Contenu principal --}}
        <main id="main-content" class="flex-1 py-6 sm:py-10 px-2 sm:px-4" role="main">
            <div class="max-w-4xl mx-auto">
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

        {{-- Footer global --}}
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

    {{-- ✅ Scripts poussés depuis les vues --}}
    @stack('scripts')

    {{-- ✅ Script global : protection images --}}
    <script>
        document.addEventListener("contextmenu", function(e) {
            if (e.target.classList.contains('protected-image')) {
                e.preventDefault();
                alert("🚫 Copie interdite !");
            }
        });
    </script>
</body>

</html>
