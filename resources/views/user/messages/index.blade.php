@extends('layouts.user')

@section('title', 'Mes messages')

@section('content')
    <div class="p-6 space-y-10">
        <h1 class="text-2xl font-bold mb-6">📨 Centre de messagerie</h1>

        {{-- ✅ Tous les messages --}}
        <div>
            <h2 class="text-xl font-bold mb-4">📑 Tous mes messages</h2>
            <div class="bg-white rounded-xl shadow-md p-4 overflow-x-auto">
                <table class="min-w-full text-sm border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4">Objet</th>
                            <th class="py-2 px-4">De</th>
                            <th class="py-2 px-4">À</th>
                            <th class="py-2 px-4">Date</th>
                            <th class="py-2 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $msg)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $msg->subject ?? '—' }}</td>
                                <td class="py-2 px-4">{{ $msg->name }}</td>
                                <td class="py-2 px-4">{{ $msg->recipient_id == Auth::id() ? 'Moi' : 'Admin' }}</td>
                                <td class="py-2 px-4">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{ route('messages.show', $msg->id) }}"
                                        class="text-blue-600 hover:underline">Voir</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-3 text-center text-gray-500">Aucun message trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ✅ Messages envoyés --}}
        <div>
            <h2 class="text-xl font-bold mb-4">📤 Messages envoyés</h2>
            <div class="bg-white rounded-xl shadow-md p-4 overflow-x-auto">
                <table class="min-w-full text-sm border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4">Objet</th>
                            <th class="py-2 px-4">À</th>
                            <th class="py-2 px-4">Date</th>
                            <th class="py-2 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sentMessages as $msg)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $msg->subject ?? '—' }}</td>
                                <td class="py-2 px-4">Admin</td>
                                <td class="py-2 px-4">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{ route('messages.show', $msg->id) }}"
                                        class="text-blue-600 hover:underline">Voir</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-3 text-center text-gray-500">Aucun message envoyé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ✅ Messages reçus --}}
        <div>
            <h2 class="text-xl font-bold mb-4">📥 Messages reçus</h2>
            <div class="bg-white rounded-xl shadow-md p-4 overflow-x-auto">
                <table class="min-w-full text-sm border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4">Objet</th>
                            <th class="py-2 px-4">De</th>
                            <th class="py-2 px-4">Date</th>
                            <th class="py-2 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($receivedMessages as $msg)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $msg->subject ?? '—' }}</td>
                                <td class="py-2 px-4">{{ $msg->name }}</td>
                                <td class="py-2 px-4">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-2 px-4 flex gap-3">
                                    <a href="{{ route('messages.show', $msg->id) }}"
                                        class="text-blue-600 hover:underline">Voir</a>

                                    {{-- Répondre --}}
                                    <form action="{{ route('messages.reply', $msg->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="reply" value="Merci pour votre message !">
                                        <button type="submit" class="text-green-600 hover:underline">Répondre</button>
                                    </form>

                                    {{-- Supprimer --}}
                                    <form action="{{ route('messages.destroy', $msg->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>

                                    {{-- Restaurer (si supprimé) --}}
                                    @if ($msg->trashed())
                                        <form action="{{ route('messages.restore', $msg->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="text-yellow-600 hover:underline">Restaurer</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-3 text-center text-gray-500">Aucun message reçu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ✅ Formulaire nouveau message --}}
        <div>
            <h2 class="text-xl font-bold mb-4">✍️ Nouveau message</h2>
            <div class="bg-white rounded-xl shadow-md p-4">
                <form action="{{ route('messages.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium">Sujet</label>
                        <input type="text" name="subject" class="w-full border rounded px-3 py-2"
                            placeholder="Sujet du message">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Message</label>
                        <textarea name="message" class="w-full border rounded px-3 py-2" rows="4" placeholder="Votre message"></textarea>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
