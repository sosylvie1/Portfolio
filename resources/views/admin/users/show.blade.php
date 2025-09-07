@extends('layouts.admin')



@section('title', "Utilisateur : {$user->name}")

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    
    {{-- Titre --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        👤 Détails de l’utilisateur
    </h1>

    {{-- Carte utilisateur --}}
    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
        <dl class="divide-y divide-gray-200">
            <div class="py-3 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500">ID</dt>
                <dd class="col-span-2 text-sm text-gray-900">{{ $user->id }}</dd>
            </div>

            <div class="py-3 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500">Nom</dt>
                <dd class="col-span-2 text-sm text-gray-900">{{ $user->name }}</dd>
            </div>

            <div class="py-3 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500">Email</dt>
                <dd class="col-span-2 text-sm text-gray-900">{{ $user->email }}</dd>
            </div>

            <div class="py-3 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500">Rôle</dt>
                <dd class="col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </dd>
            </div>

            <div class="py-3 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500">Créé le</dt>
                <dd class="col-span-2 text-sm text-gray-900">
                    {{ $user->created_at->format('d/m/Y H:i') }}
                </dd>
            </div>

            <div class="py-3 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500">Dernière modification</dt>
                <dd class="col-span-2 text-sm text-gray-900">
                    {{ $user->updated_at->format('d/m/Y H:i') }}
                </dd>
            </div>
        </dl>
    </div>

    {{-- Boutons A REVOIR --}}
    <div class="mt-6 flex gap-4">
        <a href="{{ route('admin.users.index') }}" 
           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">
           ⬅ Retour à la liste
        </a>

        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition">
                🗑 Supprimer
            </button>
        </form>
    </div>
</div>
@endsection
