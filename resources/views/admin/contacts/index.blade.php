@extends('layouts.admin')

@section('title', 'Messages reçus')

@section('content')
    <h1 class="text-2xl font-bold mb-6">📥 Messages reçus</h1>

    @if($messages->isEmpty())
        <p class="text-gray-600">Aucun message pour l’instant.</p>
    @else
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full border border-gray-200 text-sm">
                <thead class="bg-gray-100 border-b text-gray-300">
                    <tr>
                        <th class="px-4 py-2 text-left">De</th>
                        <th class="px-4 py-2 text-left">Sujet</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Lu ?</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $msg)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $msg->name }} ({{ $msg->email }})</td>
                            <td class="px-4 py-2">{{ $msg->subject ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">
                                @if($msg->is_read)
                                    ✅
                                @else
                                    ❌
                                @endif
                            </td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('admin.contacts.show', $msg->id) }}"
                                   class="text-blue-600 hover:underline">Voir</a>

                                <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST"
                                      onsubmit="return confirm('Supprimer définitivement ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    @endif
@endsection
