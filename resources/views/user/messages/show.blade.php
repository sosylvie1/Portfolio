@extends('layouts.user')

@section('content')
    <h1 class="text-2xl font-bold mb-6">📨 Message</h1>

    <div class="bg-white rounded-xl shadow-md p-6 max-w-2xl mx-auto">
        <!-- Infos message -->
        <div class="mb-4">
            <p class="text-lg font-semibold mb-2">Objet : <span class="text-gray-800">{{ $message->subject }}</span></p>
            <p class="text-sm text-gray-600">
                <strong>De :</strong> {{ $message->user->name ?? 'Inconnu' }} <br>
                <strong>Date :</strong> {{ $message->created_at->format('d/m/Y H:i') }}
            </p>
        </div>

        <!-- Contenu du message -->
        <div class="border-t border-gray-200 pt-4">
            <p class="text-gray-700 whitespace-pre-line">
                {{ $message->message ?? '— Aucun contenu —' }}
            </p>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex justify-between items-center">
            {{-- 🔄 Bouton retour dynamique --}}
            @if(str_contains(url()->previous(), 'messages/envoyes'))
                <a href="{{ route('messages.envoyes') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                    ⬅ Retour aux envoyés
                </a>
            @elseif(str_contains(url()->previous(), 'messages/recus'))
                <a href="{{ route('messages.recus') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                    ⬅ Retour aux reçus
                </a>
            @elseif(str_contains(url()->previous(), 'messages/supprimes'))
                <a href="{{ route('messages.supprimes') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                    ⬅ Retour à la corbeille
                </a>
            @else
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                    ⬅ Retour
                </a>
            @endif

            {{-- 🔥 Gestion suppression / restauration --}}
            @if($message->trashed())
                <!-- Restaurer -->
                <form action="{{ route('messages.restore', $message->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                        ♻ Restaurer
                    </button>
                </form>

                <!-- Supprimer définitivement -->
                <form action="{{ route('messages.forceDelete', $message->id) }}" method="POST" class="inline ml-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition">
                        ❌ Supprimer définitivement
                    </button>
                </form>
            @else
                <!-- Supprimer normal -->
                <form action="{{ route('messages.destroy', $message->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        🗑 Supprimer
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection
