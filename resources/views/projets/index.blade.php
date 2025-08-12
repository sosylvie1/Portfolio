@extends('layouts.app')

@section('title', 'Mes Projets')

@section('content')


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Titre de page --}}
        <h1 class="text-2xl sm:text-3xl font-bold mb-8">Mes Projets</h1>

        {{-- Grille responsive : 1 colonne mobile / 2 colonnes tablette / 3 colonnes desktop --}}

        <div id="projectsGrid" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-8">
            @forelse ($projects as $p)
                <x-project-card :p="$p" />
                @empty
            <p class="text-gray-600">Aucun projet pour le moment.</p>
            @endforelse
        </div>
    @endsection
