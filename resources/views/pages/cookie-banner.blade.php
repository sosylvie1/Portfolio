@if (!Cookie::has('cookie_consent'))
    <div id="cookie-banner" class="fixed bottom-0 inset-x-0 bg-gray-900 text-white p-4 z-50">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm">
                🍪 Ce site utilise des cookies pour améliorer votre expérience.
                Vous pouvez accepter, refuser ou personnaliser vos choix.
            </p>

            <div class="flex gap-2">
                {{-- ✅ Tout accepter --}}
                <form method="POST" action="{{ route('cookie-consent.store') }}">
                    @csrf
                    <input type="hidden" name="analytics" value="1">
                    <input type="hidden" name="marketing" value="1">
                    <button type="submit"
                        class="px-5 py-2 bg-green-700 hover:bg-green-800 text-white text-sm font-semibold rounded transition focus:ring-2 focus:ring-green-400">
                        ✅ Tout accepter
                    </button>
                </form>

                {{-- ❌ Tout refuser --}}
                <form method="POST" action="{{ route('cookie-consent.store') }}">
                    @csrf
                    <input type="hidden" name="analytics" value="0">
                    <input type="hidden" name="marketing" value="0">
                    <button type="submit"
                        class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded transition focus:ring-2 focus:ring-red-400">
                        ❌ Tout refuser
                    </button>
                </form>

                {{-- ⚙️ Personnaliser --}}
                <button type="button" id="open-cookie-modal"
                    class="px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-black text-sm font-semibold rounded transition focus:ring-2 focus:ring-yellow-300">
                    ⚙️ Personnaliser
                </button>
            </div>
        </div>
    </div>

    {{-- MODAL Personnalisation --}}
    <div id="cookie-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        role="dialog" aria-labelledby="cookie-modal-title" aria-modal="true">
        <div class="bg-white text-gray-800 p-6 rounded-lg shadow-lg w-96">
            <h2 id="cookie-modal-title" class="text-lg font-bold mb-4">Paramètres des cookies</h2>
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

                <div class="mt-4 flex justify-between">
                    <button type="button" id="close-cookie-modal"
                        class="px-3 py-1 bg-gray-400 text-white rounded hover:bg-gray-500 transition focus:ring-2 focus:ring-gray-300">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition focus:ring-2 focus:ring-blue-400">
                        💾 Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif
