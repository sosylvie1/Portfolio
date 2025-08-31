@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="{ open: false, image: '' }">
    <h1 class="text-3xl font-bold mb-6 text-center">
        🌍 {{ $voyage->pays }} ({{ $voyage->annee }})
    </h1>

    <p class="text-center text-gray-600 mb-8">{{ $voyage->description }}</p>

    <!-- Galerie photos (si tu en as plusieurs plus tard) -->
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
        <img src="{{ asset($voyage->photo) }}" 
             alt="{{ $voyage->pays }}"
             class="w-full h-64 object-cover rounded-lg shadow cursor-pointer"
             @click="open = true; image = '{{ asset($voyage->photo) }}'">

        {{-- Exemple si tu ajoutes d’autres photos un jour --}}
        <h1 class="text-3xl font-bold mb-6 text-center">
    🌍 {{ $voyage->pays }} ({{ $voyage->annee }})
</h1>

<p class="text-gray-600 mb-6 text-center">{{ $voyage->description }}</p>

<div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
    @if($voyage->photos)
        @foreach($voyage->photos as $photo)
            <img src="{{ asset($photo) }}" 
                 alt="{{ $voyage->pays }}" 
                 class="w-full h-64 object-cover rounded-lg shadow cursor-pointer">
        @endforeach
    @endif
</div>

    <!-- Lightbox -->
    <div x-show="open"
         class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50"
         x-transition>
        <div class="relative">
            <button @click="open = false"
                    class="absolute top-2 right-2 bg-white rounded-full p-2 shadow hover:bg-gray-200">
                ✖
            </button>
            <img :src="image" class="max-h-[90vh] max-w-[90vw] rounded-lg shadow-lg">
        </div>
    </div>
</div>
@endsection
