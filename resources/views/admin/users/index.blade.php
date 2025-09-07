@extends('layouts.admin')

@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">
    <h1 class="text-2xl font-bold mb-6">👤 Liste des utilisateurs</h1>

    @if($users->isEmpty())
        <p class="text-gray-600">Aucun utilisateur enregistré.</p>
    @else
        <table class="min-w-full border border-gray-200 bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Nom</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Rôle</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $user->id }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->role ?? '—' }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('admin.users.show', $user->id) }}" 
                               class="text-blue-600 hover:underline">Voir</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:underline"
                                        onclick="return confirm('Supprimer cet utilisateur ?')">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
