@extends('layouts.user')

@section('title', 'Messages envoyés')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">📤 Mes messages envoyés</h1>

    @if ($messages->isEmpty())
        <p class="text-gray-600">Vous n'avez envoyé aucun message.</p>
    @else
        <ul class="space-y-4">
            @foreach ($messages as $message)
                <li class="p-4 bg-gray-50 rounded border shadow-sm">
                    <p><strong>À :</strong> {{ $message->recipient_id ?? 'Admin' }}</p>
                    <p><strong>Sujet :</strong> {{ $message->subject ?? '(Sans sujet)' }}</p>
                    <p class="text-gray-700 mt-2">{{ Str::limit($message->message, 100) }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        Envoyé le {{ $message->created_at->format('d/m/Y H:i') }}
                    </p>
                    <a href="{{ route('messages.show', $message->id) }}" class="text-blue-600 hover:underline">👁️ Voir</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
