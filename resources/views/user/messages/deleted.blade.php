@extends('layouts.user')

@section('content')
    <h1 class="text-2xl font-bold mb-6">🗑️ Messages supprimés</h1>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($messages as $message)
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition p-4 flex flex-col justify-between">
                <!-- Sujet + Date -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">
                        {{ $message->subject }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        Supprimé le {{ $message->deleted_at->format('d/m/Y H:i') }}
                    </p>
                </div>

                <!-- Actions -->
                <div class="mt-4 flex justify-between">
                    <!-- Restaurer -->
                    <form action="{{ route('messages.restore', $message->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                            ♻️ Restaurer
                        </button>
                    </form>

                    <!-- Supprimer définitivement -->
                    <form action="{{ route('messages.forceDelete', $message->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-1 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition">
                            ❌ Supprimer
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-full text-center">Aucun message supprimé.</p>
        @endforelse
    </div>
@endsection
