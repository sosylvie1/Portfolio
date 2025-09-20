<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Affiche le formulaire public
    public function showForm()
    {
        return view('pages.contact');
    }

    // Traite l’envoi du formulaire public
    public function send(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'subject'      => 'nullable|string|max:255',
            'message'      => 'required|string',
        ]);

        // Champs système selon ta BDD
        $validated['user_id'] = Auth::id();   // null si visiteur
        $validated['is_read'] = false;        // non lu
        $validated['status']  = 'nouveau';    // statut initial

        // Enregistrement
        $message = ContactMessage::create($validated);

        // Envoi mail vers ta boîte Roundcube
        Mail::to('contact@sylvie-seguinaud.fr')->send(
            new ContactMessageMail($message)
        );

        return back()->with('success', '✅ Merci, votre message a bien été envoyé.');
    }
}
