@extends('layouts.user')

@section('title', 'Dashboard utilisateur')

@section('content')
    <div class="bg-white shadow rounded-lg p-6 w-full lg:w-2/3">
        <h2 class="text-xl font-bold mb-2"> Bienvenue {{ Auth::user()->name }} </h2>
        <p class="text-gray-700">
            Je suis ravie de vous retrouver ici dans votre espace personnel.
            Depuis ce tableau de bord, vous pouvez consulter vos <strong>messages</strong>,
            gérer <strong>votre profil</strong> et accéder à mon <strong>CV</strong>.
        </p>
        <p class="mt-4 italic text-gray-600">
            🐟 — <strong>Sylvie </strong>
        </p>
    </div>
@endsection