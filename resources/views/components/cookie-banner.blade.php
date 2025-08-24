@php
    $consentCookie = request()->cookie('cookie_consent');
@endphp

@if (!$consentCookie)
<div x-data="cookieBanner()" x-init="init()" class="fixed inset-x-0 bottom-0 z-50" aria-live="polite">
  <div class="mx-auto max-w-5xl m-4 p-4 rounded-xl border bg-white shadow-lg">
    <div class="md:flex md:items-start md:gap-6">
      <div class="flex-1">
        <h2 class="font-semibold text-lg mb-1">Cookies</h2>
        <p class="text-sm text-gray-600">
          Nous utilisons des cookies nécessaires au fonctionnement du site, ainsi que des cookies d’analyse et marketing (optionnels).
          Vous pouvez accepter tout, refuser les non-essentiels ou personnaliser.
        </p>

        <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2" x-show="showOptions">
          <label class="flex items-center gap-2">
            <input type="checkbox" checked disabled class="rounded">
            <span>Fonctionnels (obligatoires)</span>
          </label>
          <label class="flex items-center gap-2">
            <input type="checkbox" x-model="analytics" class="rounded">
            <span>Analytique</span>
          </label>
          <label class="flex items-center gap-2">
            <input type="checkbox" x-model="marketing" class="rounded">
            <span>Marketing</span>
          </label>
        </div>
      </div>

      <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
        <button @click="acceptAll" class="px-4 py-2 rounded-lg bg-gray-900 text-white hover:opacity-90">
          Tout accepter
        </button>
        <button @click="rejectNonEssential" class="px-4 py-2 rounded-lg border hover:bg-gray-50">
          Tout refuser (sauf nécessaires)
        </button>
        <button @click="toggleOptions" class="px-4 py-2 rounded-lg border hover:bg-gray-50">
          Personnaliser
        </button>
      </div>
    </div>
  </div>
</div>

<script>
function cookieBanner() {
  return {
    analytics: false,
    marketing: false,
    showOptions: false,

    init() {},

    toggleOptions() { this.showOptions = !this.showOptions; },

    post(payload) {
      return fetch("{{ route('cookie-consent.store') }}", {
        method: 'POST',
        credentials: 'same-origin', // IMPORTANT pour la session/CSRF
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
        },
        body: JSON.stringify(payload)
      }).then(async (r) => {
        if (!r.ok) {
          const text = await r.text();
          console.error('POST /cookie-consent failed', r.status, text);
          throw new Error('http_' + r.status);
        }
        return r.json();
      });
    },

    acceptAll() {
      this.analytics = true; this.marketing = true;
      this.saveAndHide();
    },

    rejectNonEssential() {
      this.analytics = false; this.marketing = false;
      this.saveAndHide();
    },

    saveAndHide() {
      this.post({ analytics: this.analytics, marketing: this.marketing })
        .then(() => {
          // Supprime proprement le composant Alpine
          this.$root.remove();
        })
        .catch(() => alert("Erreur lors de l'enregistrement du consentement"));
    }
  }
}
</script>
@endif
