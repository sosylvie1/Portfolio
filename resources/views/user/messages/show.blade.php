@extends('layouts.user')

@section('title', 'Détail du message')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">📩 Détail du message</h1>

    <p><strong>De :</strong> {{ $message->user->name ?? $message->email }}</p>
    <p><strong>À :</strong> {{ $message->recipient_id ?? 'Admin' }}</p>
    <p><strong>Sujet :</strong> {{ $message->subject ?? '(Sans sujet)' }}</p>
    <p class="mt-4 whitespace-pre-line">{{ $message->message }}</p>

    <p class="text-sm text-gray-500 mt-4">
        Envoyé le {{ $message->created_at->format('d/m/Y H:i') }}
    </p>

    <div class="mt-6 flex justify-between">
        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">⬅ Retour</a>

        <form method="POST" action="{{ route('messages.destroy', $message->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                🗑️ Supprimer
            </button>
        </form>
    </div>
</div>
@endsection
