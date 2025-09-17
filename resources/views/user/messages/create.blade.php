@extends('layouts.user')

@section('title', 'Nouveau message')

@section('content')
    <h1 class="text-2xl font-bold mb-6">✉️ Écrire un nouveau message</h1>

    <div class="bg-white rounded-xl shadow-md p-6 max-w-2xl mx-auto">
        <form action="{{ route('messages.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Sujet -->
            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700">Sujet</label>
                <input type="text" name="subject" id="subject"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                       placeholder="Objet du message (optionnel)" value="{{ old('subject') }}">
                @error('subject')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Message -->
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="6" required
                          class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-between items-center">
                <a href="{{ route('messages.envoyes') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                    ⬅ Annuler
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                    📩 Envoyer
                </button>
            </div>
        </form>
    </div>
@endsection
