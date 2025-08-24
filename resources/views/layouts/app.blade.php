<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- guest.blade.php --}}

    <head>
        {{-- … --}}
        <title>@yield('title', config('app.name'))</title>
    </head>

    <title>Sylvie Seguinaud</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Styles & app scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="min-h-screen">

        {{-- Navigation --}}
        @include('layouts.navigation')

        {{-- Titre éventuel --}}
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Contenu principal --}}
        <main class="py-10 px-4">
            @yield('content')

            {{-- Petit lien pour re-gérer les cookies (peut être déplacé en footer)
            <div class="mt-10 text-center">
                <button class="text-xs text-gray-600 underline"
                    onclick="document.cookie='cookie_consent=; path=/; Max-Age=0'; location.reload();">
                    Gérer mes cookies
                </button>
            </div> --}}
        </main>
    </div>
        

    {{-- Footer global --}}
    <footer class="bg-gray-100 border-t mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">

            {{-- © --}}
            <p>&copy; {{ date('Y') }} Sylvie Seguinaud — Portfolio</p>

            {{-- Navigation footer --}}
                    
                {{-- Pages légales --}}
                <a href="{{ route('cgu') }}" class="hover:underline">CGU</a>
                <a href="{{ route('confidentialite') }}" class="hover:underline">Confidentialité</a>
                <a href="{{ route('plan-du-site') }}" class="hover:underline">Plan du site</a>
            </nav>
        </div>
    </footer>
</body>



    {{-- Bandeau cookies (doit être dans le body) --}}
    <x-cookie-banner />

    {{-- Alpine via CDN si non chargé dans app.js --}}
    <script src="https://unpkg.com/alpinejs" defer></script>

    {{-- Scripts non essentiels : ex. Google Analytics UNIQUEMENT si accepté --}}
    @php $cookieConsent = request()->cookie('cookie_consent'); @endphp
    @if ($cookieConsent === 'accepted')
        <!-- Google Analytics (remplace par ton ID) -->
        {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-XXXXXXXXXX');
        </script> --}}
    @endif

    {{-- SYNC AUTO : si connectée + cookie présent + DB vide -> on enregistre en base --}}
    @if (Auth::check() && $cookieConsent && !Auth::user()->cookie_consent_status)
        <script>
            (async () => {
                try {
                    await fetch('{{ route('cookie-consent.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute(
                                'content'),
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

    {{-- Pile de scripts des vues --}}
    @stack('scripts')
</body>

</html>
