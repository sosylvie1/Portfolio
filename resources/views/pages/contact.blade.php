@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold text-center mb-8">📩 Contact</h1>

    


    <form action="{{ route('contact.send') }}" method="POST"
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
@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ContactPage',
    'name' => 'Contact - Portfolio de Sylvie Seguinaud',
    'description' => "Page de contact pour joindre Sylvie Seguinaud, développeuse web. Envoyez un message ou retrouvez mes coordonnées.",
    'url' => url('/contact'),
    'inLanguage' => 'fr',
    'isPartOf' => [
        '@type' => 'WebSite',
        'name' => 'Portfolio de Sylvie Seguinaud',
        'url' => url('/')
    ],
    'mainEntityOfPage' => url('/contact'),
    'about' => [
        '@type' => 'Person',
        'name' => 'Sylvie Seguinaud',
        'jobTitle' => 'Développeuse Web & Web Mobile',
        'sameAs' => [
            'https://www.linkedin.com/in/sylvie-seguinaud',
            'https://github.com/sosylvie1'
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush



