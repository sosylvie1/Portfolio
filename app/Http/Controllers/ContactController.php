<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;               // ← importe le modèle
use Illuminate\Support\Facades\Mail;         // ← si tu envoies un email
use App\Mail\ContactReceived;                // ← si tu utilises le Mailable

class ContactController extends Controller
{
    // GET /contact : affiche le formulaire
    public function show()
{
    return view('pages.contact');
}


    // POST /contact : traite l’envoi
    public function send(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'subject'      => 'nullable|string|max:255',
            'message'      => 'required|string|min:10',
        ]);

        // Enregistre en base
        ContactMessage::create($validated);

        // Optionnel : envoi email à l’admin
        // Mail::to(config('mail.from.address'))->send(new ContactReceived($validated));

        return back()->with(
    'success',
    '✅ Votre message a bien été envoyé. Je vous répondrai dans les plus brefs délais.'
);

    }
}

        

       

