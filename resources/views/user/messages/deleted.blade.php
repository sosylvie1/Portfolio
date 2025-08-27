@extends('layouts.user')

@section('title', 'Messages supprimés')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">🗑️ Messages supprimés</h1>

    @if ($messages->isEmpty())
        <p class="text-gray-600">Votre corbeille est vide.</p>
    @else
        <ul class="space-y-4">
            @foreach ($messages as $message)
                <li class="p-4 bg-gray-50 rounded border shadow-sm flex justify-between items-center">
                    <div>
                        <p><strong>Sujet :</strong> {{ $message->subject ?? '(Sans sujet)' }}</p>
                        <p class="text-sm text-gray-500">
                            Supprimé le {{ $message->deleted_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <div class="flex gap-2">
                        {{-- Restaurer --}}
                        <form method="POST" action="{{ route('messages.restore', $message->id) }}">
                            @csrf
                            @method('PATCH')
                            <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Restaurer</button>
                        </form>
                        {{-- Supprimer définitivement --}}
                        <form method="POST" action="{{ route('messages.forceDelete', $message->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Supprimer</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
