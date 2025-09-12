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

            <!-- Titre -->
            <div>
                <label for="title" class="block font-semibold">Titre</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block font-semibold">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full border rounded px-3 py-2" required>{{ old('description') }}</textarea>
            </div>

            <!-- Technologies -->
            <div>
                <label for="tech" class="block font-semibold">Technologies utilisées :</label>
                <select id="tech" name="tech[]" multiple class="border rounded p-2 w-full">
                    <option value="PHP">PHP</option>
                    <option value="MySQL">MySQL</option>
                    <option value="HTML">HTML</option>
                    <option value="CSS">CSS</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="Laravel">Laravel</option>
                    <option value="React">React</option>
                </select>
                <small class="text-gray-500">Maintenir Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs</small>
            </div>

            <!-- Date -->
            <div>
                <label for="date" class="block font-semibold">Date</label>
                <input type="date" name="date" id="date" value="{{ old('date') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block font-semibold">Image</label>
                <input type="file" name="image" id="image"
                       class="w-full border rounded px-3 py-2">
            </div>

            <!-- Liens optionnels -->
            <div>
                <label for="github" class="block font-semibold">Lien GitHub</label>
                <input type="url" name="github" id="github" value="{{ old('github') }}"
                       class="w-full border rounded px-3 py-2" placeholder="https://github.com/...">
            </div>

            <div>
                <label for="readme" class="block font-semibold">Lien README</label>
                <input type="url" name="readme" id="readme" value="{{ old('readme') }}"
                       class="w-full border rounded px-3 py-2" placeholder="https://...">
            </div>

            <div>
                <label for="video" class="block font-semibold">Lien Vidéo</label>
                <input type="url" name="video" id="video" value="{{ old('video') }}"
                       class="w-full border rounded px-3 py-2" placeholder="https://youtube.com/...">
            </div>

            <div>
                <label for="figma" class="block font-semibold">Lien Figma</label>
                <input type="url" name="figma" id="figma" value="{{ old('figma') }}"
                       class="w-full border rounded px-3 py-2" placeholder="https://figma.com/...">
            </div>

            <!-- Boutons -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.projets.index') }}" class="px-4 py-2 border rounded">Annuler</a>
                <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
@endsection
