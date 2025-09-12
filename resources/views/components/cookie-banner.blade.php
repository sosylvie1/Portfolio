@if (! Cookie::has('cookie_consent'))
<div id="cookie-banner"
     class="fixed bottom-4 left-1/2 transform -translate-x-1/2 w-[90%] md:w-[70%] bg-gray-800 text-white p-6 rounded-xl shadow-xl z-50"
     role="dialog"
     aria-label="Bandeau de consentement aux cookies">

    <div class="flex flex-col gap-4">
        {{-- Texte --}}
        <p class="text-sm md:text-base text-center">
            🍪 Ce site utilise des cookies pour améliorer votre expérience. 
            <a href="{{ route('confidentialite') }}" 
               class="underline hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-white focus:rounded-sm">
               En savoir plus
            </a>
        </p>

        {{-- Boutons sur la même ligne --}}
        <div class="flex justify-center gap-3">
            
            {{-- Accepter --}}
            <form method="POST" action="{{ route('cookie-consent.store') }}">
                @csrf
                <input type="hidden" name="analytics" value="1">
                <input type="hidden" name="marketing" value="1">
                <button type="submit"
                        aria-label="Accepter tous les cookies"
                        class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg shadow">
                    ✅ Accepter
                </button>
            </form>

            {{-- Personnaliser --}}
            <button type="button"
                    aria-label="Personnaliser vos choix de cookies"
                    onclick="document.getElementById('cookie-modal').classList.remove('hidden')"
                    class="px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold rounded-lg shadow">
                ⚙️ Personnaliser
            </button>

            {{-- Refuser --}}
            <form method="POST" action="{{ route('cookie-consent.store') }}">
                @csrf
                <input type="hidden" name="analytics" value="0">
                <input type="hidden" name="marketing" value="0">
                <button type="submit"
                        aria-label="Refuser tous les cookies"
                        class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg shadow">
                    ❌ Refuser
                </button>
            </form>
        </div>
    </div>
</div>

{{-- MODAL Personnalisation --}}
<div id="cookie-modal" 
     class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50"
     role="dialog"
     aria-modal="true"
     aria-labelledby="cookie-settings-title">
    <div class="bg-white text-gray-800 p-6 rounded-xl shadow-xl w-11/12 sm:w-96">
        <h2 id="cookie-settings-title" class="text-lg font-bold mb-4">Paramètres des cookies</h2>
        
        <form method="POST" action="{{ route('cookie-consent.store') }}">
            @csrf
            <div class="space-y-3">
                <label class="flex items-center gap-2">
                    <input type="checkbox" checked disabled>
                    <span>Cookies fonctionnels (toujours actifs)</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="analytics" value="1">
                    <span>Cookies analytiques</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="marketing" value="1">
                    <span>Cookies marketing</span>
                </label>
            </div>

            <div class="mt-6 flex justify-between">
                <button type="button"
                        onclick="document.getElementById('cookie-modal').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 text-sm font-semibold shadow">
                    Annuler
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-semibold shadow">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endif
