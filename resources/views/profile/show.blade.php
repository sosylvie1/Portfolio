@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">

            <h1 class="text-2xl font-semibold mb-4">Mon profil</h1>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500">Nom</p>
                    <p class="text-lg font-medium">{{ auth()->user()->name }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="text-lg font-medium">{{ auth()->user()->email }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Société</p>
                    <p class="text-lg font-medium">{{ auth()->user()->company_name ?? '—' }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Téléphone</p>
                    <p class="text-lg font-medium">{{ auth()->user()->phone ?? '—' }}</p>
                </div>
            </div>

            <div class="pt-2">
                <a href="{{ route('profile.edit') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                    Modifier mon profil
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
