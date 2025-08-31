@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="{ open: false, image: '' }">
    <h1 class="text-3xl font-bold mb-6 text-center">🌍 Plus qu’un voyage, une rencontre avec les pays et leurs habitants  </h1>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($voyages as $voyage)
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden">
                <!-- Image cliquable -->
                <img src="{{ asset($voyage->photo) }}" 
                     alt="{{ $voyage->pays }}" 
                     class="w-full h-48 object-cover cursor-pointer"
                     @click="open = true; image = '{{ asset($voyage->photo) }}'">

                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $voyage->pays }} ({{ $voyage->annee }})
                    </h2>
                    <p class="text-gray-600 text-sm mt-2">{{ $voyage->description }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modale Lightbox -->
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

