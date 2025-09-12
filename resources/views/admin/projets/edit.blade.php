@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-xl font-bold mb-4">✏️ Modifier un projet</h1>

        {{-- Message flash --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.projets.update', $project->id) }}" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Titre --}}
            <div>
                <label class="block font-semibold">Titre</label>
                <input type="text" name="title" class="w-full border rounded p-2"
                    value="{{ old('title', $project->title) }}" required>
                @error('title')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label class="block font-semibold">Slug</label>
                <input type="text" name="slug" class="w-full border rounded p-2"
                    value="{{ old('slug', $project->slug) }}" required>
                @error('slug')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block font-semibold">Description</label>
                <textarea name="description" class="w-full border rounded p-2" rows="3">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div>
                <label class="block font-semibold">Image</label>
                @if ($project->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="Aperçu"
                            class="h-32 rounded shadow border">
                    </div>
                @endif
                <input type="file" name="image" class="w-full">
                @error('image')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Technologies --}}
            <div>
                <label class="block font-semibold">Technologies (séparées par virgules)</label>
                <input type="text" name="tech" class="w-full border rounded p-2"
                    value="{{ old('tech', is_string($project->tech) ? implode(',', json_decode($project->tech, true) ?? []) : '') }}">
            </div>



            {{-- Liens --}}
            <div>
                <label class="block font-semibold">Lien GitHub</label>
                <input type="url" name="github" class="w-full border rounded p-2"
                    value="{{ old('github', $project->github) }}">
            </div>

            <div>
                <label class="block font-semibold">Lien Démo</label>
                <input type="url" name="live" class="w-full border rounded p-2"
                    value="{{ old('live', $project->live) }}">
            </div>

            <div>
                <label class="block font-semibold">Lien Figma</label>
                <input type="url" name="figma" class="w-full border rounded p-2"
                    value="{{ old('figma', $project->figma) }}">
            </div>

            {{-- Date --}}
            <div>
                <label class="block font-semibold">Date</label>
                <input type="date" name="date" class="w-full border rounded p-2"
                    value="{{ old('date', $project->date ? $project->date->format('Y-m-d') : '') }}">
            </div>

            {{-- Publication --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_published" value="1"
                    {{ old('is_published', $project->is_published) ? 'checked' : '' }}>
                <label>Publié</label>
            </div>

            {{-- Ordre --}}
            <div>
                <label class="block font-semibold">Ordre d’affichage</label>
                <input type="number" name="order" class="w-full border rounded p-2"
                    value="{{ old('order', $project->order) }}">
            </div>

            {{-- Boutons --}}
            <div class="flex justify-between">
                <a href="{{ route('admin.projets.index') }}" class="px-4 py-2 bg-gray-300 rounded">⬅ Retour</a>
                <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded">💾 Mettre à jour</button>
            </div>
        </form>
    </div>
@endsection
