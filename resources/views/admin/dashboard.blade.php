@extends('layouts.admin')

@section('content')
@section('robots', 'noindex, nofollow')
@php
  $totalProjects  = $totalProjects  ?? 0;
  $totalUsers     = $totalUsers     ?? 0;
  $totalMessages  = $totalMessages  ?? 0;

  $latestProjects = $latestProjects ?? collect();
  $latestUsers    = $latestUsers    ?? collect();
  $latestMessages = $latestMessages ?? collect();
@endphp

<div class="px-4 md:px-8 py-6">
  <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

  {{-- Cartes stats --}}
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <a href="{{ route('admin.projets.index') }}" class="block p-5 rounded-2xl border bg-white shadow hover:shadow-md transition">
      <div class="text-sm text-gray-500">Projets</div>
      <div class="text-3xl font-semibold">{{ $totalProjects }}</div>
      <div class="mt-2 text-xs text-gray-400">Voir tous les projets →</div>
    </a>

    <a href="{{ route('admin.users.index') }}" class="block p-5 rounded-2xl border bg-white shadow hover:shadow-md transition">
      <div class="text-sm text-gray-500">Utilisateurs</div>
      <div class="text-3xl font-semibold">{{ $totalUsers }}</div>
      <div class="mt-2 text-xs text-gray-400">Voir tous les utilisateurs →</div>
    </a>

    <a href="{{ route('admin.contacts.index') }}" class="block p-5 rounded-2xl border bg-white shadow hover:shadow-md transition">
      <div class="text-sm text-gray-500">Messages</div>
      <div class="text-3xl font-semibold">{{ $totalMessages }}</div>
      <div class="mt-2 text-xs text-gray-400">Voir tous les messages →</div>
    </a>
  </div>

  {{-- Derniers projets --}}
  <div class="bg-white rounded-2xl border shadow p-5 mb-8">
    <div class="flex items-center justify-between mb-4">
      <h2 class="font-semibold text-lg">Derniers projets</h2>
      <a href="{{ route('admin.projets.index') }}" class="text-sm text-pink-600 hover:underline">Tout voir</a>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="text-left text-gray-500 border-b">
            <th class="py-2 pr-4">Titre</th>
            <th class="py-2 pr-4">Créé le</th>
            <th class="py-2 pr-4">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($latestProjects as $p)
            <tr class="border-b hover:bg-gray-50">
              <td class="py-2 pr-4 font-medium">{{ $p->title }}</td>
              <td class="py-2 pr-4 text-gray-600">{{ $p->created_at?->format('d/m/Y H:i') }}</td>
              <td class="py-2 pr-4">
                <a href="{{ route('admin.projets.edit', $p) }}" class="text-blue-600 hover:underline">Éditer</a>
              </td>
            </tr>
          @empty
            <tr><td colspan="3" class="py-3 text-gray-500">Aucun projet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Derniers messages --}}
  <div class="bg-white rounded-2xl border shadow p-5 mb-8">
    <div class="flex items-center justify-between mb-4">
      <h2 class="font-semibold text-lg">Derniers messages</h2>
      <a href="{{ route('admin.contacts.index') }}" class="text-sm text-pink-600 hover:underline">Tout voir</a>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="text-left text-gray-500 border-b">
            <th class="py-2 pr-4">De</th>
            <th class="py-2 pr-4">Sujet</th>
            <th class="py-2 pr-4">Reçu le</th>
            <th class="py-2 pr-4">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($latestMessages as $m)
            <tr class="border-b hover:bg-gray-50">
              <td class="py-2 pr-4">{{ $m->name ?? $m->email }}</td>
              <td class="py-2 pr-4">{{ \Illuminate\Support\Str::limit($m->subject ?? '-', 60) }}</td>
              <td class="py-2 pr-4 text-gray-600">{{ $m->created_at?->format('d/m/Y H:i') }}</td>
              <td class="py-2 pr-4">
                <a href="{{ route('admin.contacts.show', $m) }}" class="text-blue-600 hover:underline">Voir</a>
              </td>
            </tr>
          @empty
            <tr><td colspan="4" class="py-3 text-gray-500">Aucun message.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Derniers utilisateurs --}}
  <div class="bg-white rounded-2xl border shadow p-5">
    <div class="flex items-center justify-between mb-4">
      <h2 class="font-semibold text-lg">Derniers utilisateurs</h2>
      <a href="{{ route('admin.users.index') }}" class="text-sm text-pink-600 hover:underline">Tout voir</a>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="text-left text-gray-500 border-b">
            <th class="py-2 pr-4">Nom</th>
            <th class="py-2 pr-4">Email</th>
            <th class="py-2 pr-4">Inscrit le</th>
          </tr>
        </thead>
        <tbody>
          @forelse($latestUsers as $u)
            <tr class="border-b hover:bg-gray-50">
              <td class="py-2 pr-4 font-medium">{{ $u->name }}</td>
              <td class="py-2 pr-4">{{ $u->email }}</td>
              <td class="py-2 pr-4 text-gray-600">{{ $u->created_at?->format('d/m/Y H:i') }}</td>
            </tr>
          @empty
            <tr><td colspan="3" class="py-3 text-gray-500">Aucun utilisateur.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection