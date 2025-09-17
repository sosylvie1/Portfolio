@component('mail::message')
# Bonjour {{ $originalMessage->name }},

Vous avez reçu une réponse de l’administrateur :

---

{{ $reply }}

---

Merci de nous avoir contacté.  
Cordialement,  
**Sylvie Seguinaud – Portfolio**

@endcomponent
