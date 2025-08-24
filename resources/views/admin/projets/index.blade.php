@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-6">Mes Projets (admin)</h1>
{{-- //pas de base de donnée en dure direct dans projectcontroller --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach ($projects as $project)
      <x-project-card :p="$project" />
    @endforeach
  </div>
</div>
@endsection
