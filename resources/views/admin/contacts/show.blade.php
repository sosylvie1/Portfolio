@extends('layouts.admin')
@if(session('success'))
    <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300">
        {{ session('success') }}
    </div>
@endif


@section('title', 'Détail message')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">📩 Message de {{ $message->name }}</h1>

            <p><strong>Email :</strong> {{ $message->email }}</p>
            <p><strong>Sujet :</strong> {{ $message->subject ?? '—' }}</p>
            <p><strong>Date :</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>

            <hr class="my-4">

            <div class="prose">
                {!! nl2br(e($message->message)) !!}
            </div>

            <hr class="my-6">

            {{-- Formulaire de réponse --}}
            <h2 class="text-xl font-semibold mb-2">Répondre à {{ $message->name }}</h2>
            <form method="POST" action="{{ route('admin.contacts.reply', $message->id) }}">
                @csrf
                <textarea name="reply" rows="4" class="w-full border rounded p-2 mb-3" required></textarea>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    ✉️ Envoyer la réponse
                </button>
            </form>

            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.contacts.index') }}" class="text-gray-600 hover:underline">
                    ← Retour aux messages
                </a>
                <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST"
                      onsubmit="return confirm('Supprimer définitivement ce message ?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:underline">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
