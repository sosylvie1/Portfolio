@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <a href="{{ url()->previous() }}" class="text-sm underline">← Retour</a>

    <div class="bg-white/70 border border-gray-100 rounded-2xl shadow p-6 mt-4 space-y-4">
        <div class="flex items-start justify-between">
            <h1 class="text-2xl font-bold">Message de {{ $message->name }}</h1>
            <span class="text-sm text-gray-500">{{ $message->created_at->format('d/m/Y H:i') }}</span>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <div class="text-xs uppercase text-gray-500">Email</div>
                <a href="mailto:{{ $message->email }}" class="underline">{{ $message->email }}</a>
            </div>
            <div>
                <div class="text-xs uppercase text-gray-500">Sujet</div>
                <div>{{ $message->subject ?: '—' }}</div>
            </div>
        </div>

        <div>
            <div class="text-xs uppercase text-gray-500 mb-1">Message</div>
            <div class="whitespace-pre-line leading-relaxed">{{ $message->message }}</div>
        </div>

        <div class="flex items-center justify-end gap-2 pt-4">
            <form action="{{ route('admin.contacts.mark', $message) }}" method="POST">
                @csrf @method('PUT')
                <button class="px-4 py-2 rounded border">
                    {{ $message->is_read ? 'Marquer non lu' : 'Marquer lu' }}
                </button>
            </form>
            <form action="{{ route('admin.contacts.destroy', $message) }}" method="POST"
                  onsubmit="return confirm('Supprimer ce message ?');">
                @csrf @method('DELETE')
                <button class="px-4 py-2 rounded bg-red-50 border border-red-200 text-red-700">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
