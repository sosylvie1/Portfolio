<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tableau de bord administrateur</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50" x-data="{ open:false }" x-cloak>
  <div class="min-h-screen md:flex">

    {{-- OVERLAY (mobile) --}}
    <div 
      class="fixed inset-0 bg-black/40 z-30 md:hidden"
      x-show="open"
      x-transition.opacity
      @click="open=false"
      aria-hidden="true">
    </div>

    {{-- SIDEBAR --}}
    <aside
      class="fixed inset-y-0 left-0 z-40 w-72 bg-white border-r shadow-sm
             transform -translate-x-full md:translate-x-0 md:static md:w-64
             transition-transform duration-200 ease-in-out"
      :class="{ 'translate-x-0': open }"
      role="navigation"
      aria-label="Menu d’administration"
    >
      <div class="p-4 flex items-center justify-between border-b">
        <div class="font-bold">Espace Admin</div>
        <button class="md:hidden p-2 rounded hover:bg-gray-100" @click="open=false" aria-label="Fermer le menu">✖</button>
      </div>

      @php
        $isActive = function ($pattern) {
          return request()->routeIs($pattern) ? 'bg-gray-100 text-gray-900' : 'text-gray-700';
        };
        $baseLink = 'block px-3 py-2 rounded hover:bg-gray-100 transition';
      @endphp

      <nav class="px-2 py-3 space-y-1">
        <a href="{{ route('admin.dashboard') }}"
           class="{{ $baseLink }} {{ $isActive('admin.dashboard') }}"
           @click="open=false">📊 Dashboard</a>

        {{-- Projets (admin) — Option B --}}
        <a href="{{ route('admin.projets.index') }}"
           class="{{ $baseLink }} {{ $isActive('admin.projets.*') }}"
           @click="open=false">📂 Projets</a>

        <a href="{{ route('admin.users.index') }}"
           class="{{ $baseLink }} {{ $isActive('admin.users.*') }}"
           @click="open=false">👥 Visiteurs</a>

        <a href="{{ route('admin.contacts.index') }}"
           class="{{ $baseLink }} {{ $isActive('admin.contacts.*') }}"
           @click="open=false">✉️ Messages</a>

        
        <div class="pt-2 mt-2 border-t">
          <a href="{{ route('accueil') }}"
             class="{{ $baseLink }} {{ $isActive('accueil') }}"
             @click="open=false">🏠 Accueil public</a>
        </div>
        {{-- Déconnexion --}}
        <div class="pt-2 mt-2 border-t">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
              class="w-full text-left {{ $baseLink }} text-red-600 hover:bg-red-50"
              @click="open=false">
              🚪 Déconnexion
            </button>
          </form>
        </div>
      </nav>
        
      
    </aside>

    {{-- CONTENU --}}
    <main class="flex-1 ">
      {{-- Bouton burger (mobile) --}}
      <div class="md:hidden p-3">
        <button class="inline-flex items-center gap-2 px-3 py-2 rounded border bg-white hover:bg-gray-50"
                @click="open=true"
                aria-label="Ouvrir le menu">
          ☰ <span class="text-sm">Menu</span>
        </button>
      </div>

      @yield('content')
    </main>
  </div>
  {{-- <x-cookie-banner /> --}}

  
  {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
</body>
</html>