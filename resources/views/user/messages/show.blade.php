@extends('layouts.user')

@section('content')
    <h1 class="text-2xl font-bold mb-6">📨 Message</h1>

    <div class="bg-white rounded-xl shadow-md p-6 max-w-2xl mx-auto">
        <!-- Infos -->
        <div class="mb-4">
            <p class="text-lg font-semibold mb-2">Objet : <span class="text-gray-800">{{ $message->subject }}</span></p>
            <p class="text-sm text-gray-600">
                <strong>De :</strong> {{ $message->name }} <br>
                <strong>Date :</strong> {{ $message->created_at->format('d/m/Y H:i') }}
            </p>
        </div>

        <!-- Contenu -->
        <div class="border-t border-gray-200 pt-4 mb-6">
            <p class="text-gray-700 whitespace-pre-line">{{ $message->message ?? '— Aucun contenu —' }}</p>
        </div>

        <div class="flex justify-between items-center">
            <!-- Retour -->
            <a href="{{ url()->previous() }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                ⬅ Retour
            </a>

            <!-- Si reçu → bouton répondre -->
            @if ($message->recipient_id === Auth::id())
                <form action="{{ route('messages.reply', $message->id) }}" method="POST"
                    class="flex flex-col gap-3 w-full">
                    @csrf
                    <textarea name="reply" placeholder="Votre réponse..." class="border rounded p-3 text-sm w-full min-h-[120px]"
                        required></textarea>
                    <div class="flex justify-end gap-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            📧 Répondre
                        </button>
                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                🗑 Supprimer
                            </button>
                        </form>
                    </div>
                    </form>
            @endif

            <!-- Si supprimé → options restauration/suppression -->
            @if ($message->trashed())
                <div class="flex gap-2">
                    <form action="{{ route('messages.restore', $message->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-3 py-1 bg-green-100 text-green-700 rounded-lg hover:bg-green-200">
                            ♻ Restaurer
                        </button>
                    </form>
                    <form action="{{ route('messages.forceDelete', $message->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
                            ❌ Supprimer définitivement
                        </button>
                    </form>
                </div>
            @else
                {{-- <!-- Suppression normale -->
                <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        🗑 Supprimer
                    </button>
                </form> --}}
            @endif
        </div>
    </div>
@endsection
