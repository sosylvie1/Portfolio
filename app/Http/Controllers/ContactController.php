<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * 📩 Formulaire public de contact
     */
    public function showForm()
    {
        // Vue pour les visiteurs (ex: resources/views/pages/contact.blade.php)
        return view('pages.contact');
    }

    /**
     * 📤 Traitement du formulaire public
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'subject'      => 'nullable|string|max:255',
            'message'      => 'required|string|min:10',
        ]);

        ContactMessage::create([
            'company_name' => $validated['company_name'] ?? null,
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'subject'      => $validated['subject'] ?? null,
            'message'      => $validated['message'],
            'user_id'      => null, // ⚡ utilisateur public => pas d'ID
            'recipient_id' => 1,    // ⚡ admin (id=1)
            'is_read'      => 0,
        ]);

        return back()->with('success', '✅ Merci, votre message a bien été envoyé.');
    }
}
