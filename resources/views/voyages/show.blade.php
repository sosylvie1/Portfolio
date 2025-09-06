@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">
        {{ $voyage->pays }} ({{ $voyage->annee }})
    </h1>

    <!-- Image principale -->
    <div class="mb-6">
        <img src="{{ asset($voyage->photo) }}" 
             alt="{{ $voyage->pays }}" 
             class="w-full max-h-96 object-cover rounded-lg shadow">
    </div>

    <!-- Description -->
    <p class="text-gray-600 mb-6 text-center">{{ $voyage->description }}</p>

    <!-- Galerie supplémentaire -->
    @php
        $photos = $voyage->photos ? json_decode($voyage->photos, true) : [];
    @endphp

    @if(!empty($photos))
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($photos as $photo)
                <img src="{{ asset($photo) }}" 
                     alt="{{ $voyage->pays }}" 
                     class="w-full h-64 object-cover rounded-lg shadow cursor-pointer">
            @endforeach
        </div>
    @endif

    <!-- Retour -->
    <div class="mt-8 text-center">
        <a href="{{ route('voyages.index') }}" 
           class="inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
            ⬅ Retour aux voyages
        </a>
    </div>
</div>
@endsection

