@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">📨 Messages de contact</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-6 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-4">
        <div class="text-sm text-gray-600">
            {{ $messages->total() }} message(s)
        </div>
        <div class="space-x-2">
            <a href="{{ route('admin.contacts.index') }}"
               class="px-3 py-1 rounded border">Tous</a>
            <a href="{{ route('admin.contacts.index', ['unread' => 1]) }}"
               class="px-3 py-1 rounded border bg-pink-50">Non lus</a>
        </div>
    </div>

    <div class="bg-white/70 border border-gray-100 rounded-xl shadow overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left">De</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Sujet</th>
                    <th class="px-4 py-3 text-left">Reçu</th>
                    <th class="px-4 py-3">Statut</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $m)
                    <tr class="{{ $m->is_read ? '' : 'bg-pink-50/40' }}">
                        <td class="px-4 py-3 font-medium">{{ $m->name }}</td>
                        <td class="px-4 py-3"><a href="mailto:{{ $m->email }}" class="underline">{{ $m->email }}</a></td>
                        <td class="px-4 py-3">{{ $m->subject ?: '—' }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3">
                            @if($m->is_read)
                                <span class="px-2 py-1 text-xs rounded bg-gray-100">Lu</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-pink-200">Non lu</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.contacts.show', $m) }}" class="px-3 py-1 rounded bg-white border">Voir</a>
                            <form action="{{ route('admin.contacts.mark', $m) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <button class="px-3 py-1 rounded border">
                                    {{ $m->is_read ? 'Marquer non lu' : 'Marquer lu' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.contacts.destroy', $m) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Supprimer ce message ?');">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 rounded bg-red-50 border border-red-200 text-red-700">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">Aucun message.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $messages->links() }}</div>
</div>
@endsection
