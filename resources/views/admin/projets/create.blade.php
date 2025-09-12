@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">➕ Ajouter un projet</h1>

        {{-- Messages d’erreur --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- Titre --}}
            <div>
                <label for="title" class="block font-semibold">Titre</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block font-semibold">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block font-semibold">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
            </div>

            {{-- Technologies --}}
            <div>
                <label for="tech" class="block font-semibold">Technologies (séparées par virgules)</label>
                <input type="text" name="tech" id="tech" class="w-full border rounded px-3 py-2"
                       value="{{ old('tech') }}" placeholder="Ex: PHP, MySQL, Laravel">
            </div>

            {{-- Image --}}
            <div>
                <label for="image" class="block font-semibold">Image</label>
                <input type="file" name="image" id="image" class="w-full border rounded px-3 py-2">
            </div>

            {{-- Liens --}}
            <div>
                <label for="github" class="block font-semibold">Lien GitHub</label>
                <input type="url" name="github" id="github" value="{{ old('github') }}"
                       class="w-full border rounded px-3 py-2" placeholder="https://github.com/...">
            </div>

            <div>
                <label for="live" class="block font-semibold">Lien Démo</label>
                <input type="url" name="live" id="live" value="{{ old('live') }}"
                       class="w-full border rounded px-3 py-2" placeholder="https://...">
            </div>

            <div>
                <label for="figma" class="block font-semibold">Lien Figma</label>
                <input type="url" name="figma" id="figma" value="{{ old('figma') }}"
                       class="w-full border rounded px-3 py-2" placeholder="https://figma.com/...">
            </div>

            {{-- Date --}}
            <div>
                <label for="date" class="block font-semibold">Date</label>
                <input type="date" name="date" id="date" value="{{ old('date') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            {{-- Publication --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                <label for="is_published">Publié</label>
            </div>

            {{-- Ordre --}}
            <div>
                <label for="order" class="block font-semibold">Ordre d’affichage</label>
                <input type="number" name="order" id="order" value="{{ old('order') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            {{-- Boutons --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.projets.index') }}" class="px-4 py-2 border rounded">Annuler</a>
                <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
@endsection
