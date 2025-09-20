@extends('layouts.admin')

@section('title', 'Messages reçus')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">📥 Messages reçus</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Entreprise</th>
                <th class="border p-2">Nom</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Sujet</th>
                <th class="border p-2">Statut</th>
                <th class="border p-2">Lu ?</th>
                <th class="border p-2">Date</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
                <tr class="{{ !$msg->is_read ? 'bg-pink-50' : '' }}">
                    <td class="border p-2">
                        {{ $msg->company_name ?? '-' }}
                    </td>
                    <td class="border p-2 font-semibold">
                        {{ $msg->name }}
                    </td>
                    <td class="border p-2 text-sm text-gray-600">
                        {{ $msg->email }}
                    </td>
                    <td class="border p-2">
                        {{ $msg->subject ?? '—' }}
                    </td>
                    <td class="border p-2">
                        <span class="px-2 py-1 rounded text-xs
                            {{ $msg->status === 'nouveau' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $msg->status === 'lu' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $msg->status === 'répondu' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                            {{ ucfirst($msg->status) }}
                        </span>
                    </td>
                    <td class="border p-2 text-center">
                        @if($msg->is_read)
                            ✅
                        @else
                            ❌
                        @endif
                    </td>
                    <td class="border p-2 text-sm text-gray-500">
                        {{ $msg->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="border p-2 text-sm space-x-2">
                        <a href="{{ route('admin.contacts.show', $msg->id) }}" class="text-blue-600">Voir</a>
                        @if(!$msg->is_read)
                            <a href="{{ route('admin.contacts.markAsRead', $msg->id) }}" class="text-green-600">Marquer lu</a>
                        @else
                            <a href="{{ route('admin.contacts.markAsUnread', $msg->id) }}" class="text-yellow-600">Marquer non lu</a>
                        @endif
                        <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Supprimer ce message ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="p-4 text-center text-gray-500">
                        Aucun message reçu.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
