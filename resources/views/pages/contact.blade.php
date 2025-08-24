@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold text-center mb-8">📩 Contact</h1>

    @if (session('success'))
    <div class="flex items-center gap-2 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 shadow text-center">
        <svg class="w-5 h-5 flex-shrink-0 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-sm sm:text-base font-medium">
            {{ session('success') }}
        </span>
         </div>
        <div class="flex items-center gap-2 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 shadow text-center">
        <a href="{{ route('accueil') }}"
           class="inline-block mt-2 px-4 py-2 bg-pink-500 text-white rounded-lg shadow hover:bg-pink-600 transition">
            ⬅ Retour à l'accueil
        </a>
    </div>
@endif


    <form action="{{ route('contact.submit') }}" method="POST"
          class="bg-white/60 backdrop-blur-md border border-pink-100 shadow-lg rounded-xl p-6 space-y-4">
        @csrf

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nom de société</label>
                <input name="company_name" value="{{ old('company_name') }}" required
                       class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                @error('company_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nom</label>
                <input name="name" value="{{ old('name') }}" required
                       class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Sujet (optionnel)</label>
            <input name="subject" value="{{ old('subject') }}"
                   class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">
            @error('subject') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Message</label>
            <textarea name="message" rows="6" required
                      class="mt-1 w-full rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500">{{ old('message') }}</textarea>
            @error('message') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="text-center">
            <button class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-lg shadow">
                Envoyer
            </button>
        </div>
    </form>
</div>
@endsection
