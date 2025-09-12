@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">📂 Mes Projets (admin)</h1>
        <a href="{{ route('admin.projets.create') }}"
           class="px-4 py-2 bg-pink-600 text-white rounded-lg shadow hover:bg-pink-700 transition">
            ➕ Ajouter un projet
        </a>
    </div>

    {{-- Messages flash --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($projects->isEmpty())
        <p class="text-gray-600">Aucun projet pour le moment.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($projects as $project)
                <div class="relative group border rounded-xl overflow-hidden shadow hover:shadow-md transition">
                    {{-- Affichage du projet avec ton composant --}}
                    <x-project-card :p="$project" />

                    {{-- Actions admin --}}
                    <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                        {{-- Modifier --}}
                        <a href="{{ route('admin.projets.edit', $project->id) }}"
                           class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                            ✏️ Modifier
                        </a>

                        {{-- Supprimer --}}
                        <form action="{{ route('admin.projets.destroy', $project->id) }}"
                              method="POST"
                              onsubmit="return confirm('Supprimer ce projet ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">
                                🗑️ Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
