@extends('layouts.user')

@section('title', 'Suivi du CV · Espace utilisateur')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">📄 Suivi du CV de Sylvie</h2>

        {{-- Vérification de la dernière date de téléchargement --}}
        @if (isset($lastCvDownload) && $lastCvDownload)
            <p class="text-gray-700">
                Vous avez téléchargé le CV pour la dernière fois le
                <strong>{{ $lastCvDownload->downloaded_at->format('d/m/Y à H:i') }}</strong>.
            </p>
        @else
            <p class="text-gray-600">
                Vous n'avez pas encore téléchargé le CV de Sylvie.
            </p>
        @endif

        {{-- Actions --}}
        <div class="mt-6 flex space-x-4">
            {{-- Aperçu (ouvre le PDF dans le navigateur) --}}
            <a href="{{ route('cv.preview') }}"
               target="_blank"
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                👀 Voir le CV
            </a>

            {{-- Téléchargement (réservé aux connectés) --}}
            <a href="{{ route('cv.download') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                ⬇️ Télécharger le CV
            </a>
        </div>
    </div>
@endsection
