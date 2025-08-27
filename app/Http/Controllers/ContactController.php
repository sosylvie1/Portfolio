<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Formulaire public de contact
     */
    public function showForm()
    {
        return view('pages.contact');
    }

    /**
     * Traitement envoi formulaire (public ou user connecté)
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'subject'      => 'nullable|string|max:255',
            'message'      => 'required|string|min:10',
        ]);

        ContactMessage::create([
    'company_name' => $validated['company_name'],
    'name'         => $validated['name'],
    'email'        => $validated['email'],
    'subject'      => $validated['subject'] ?? null,
    'message'      => $validated['message'],
    'user_id'      => auth()->check() ? auth()->id() : null, // ✅ uniquement si connecté
]);


        return back()->with('success', '✅ Votre message a bien été envoyé.');
    }

    /**
     * Voir un message
     */
    public function show($id)
    {
        $message = ContactMessage::where('user_id', auth()->id())->findOrFail($id);
        return view('user.messages.show', compact('message'));
    }

    /**
     * 📤 Messages envoyés par l’utilisateur
     */
    public function sent()
    {
        $messages = ContactMessage::where('user_id', auth()->id())
            ->where('status', 'sent')   // ✅ filtre sur "sent"
            ->latest()
            ->get();

        return view('user.messages.sent', compact('messages'));
    }

    /**
     * 📥 Messages reçus par l’utilisateur (ex. réponses admin)
     */
    public function received()
    {
        $messages = ContactMessage::where('user_id', auth()->id())
            ->where('status', 'received')   // ✅ filtre sur "received"
            ->latest()
            ->get();

        return view('user.messages.received', compact('messages'));
    }

    /**
     * 🗑️ Messages supprimés (corbeille)
     */
    /**
 * 🗑️ Mettre un message à la corbeille (Soft Delete)
 */
public function destroy($id)
{
    $message = ContactMessage::where('user_id', auth()->id())->findOrFail($id);
    $message->delete(); // ✅ Soft delete

    return back()->with('success', 'Message déplacé dans la corbeille.');
}

/**
 * 🗑️ Voir les messages supprimés (corbeille)
 */
public function deleted()
{
    $messages = ContactMessage::onlyTrashed() // ✅ uniquement ceux supprimés
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('user.messages.deleted', compact('messages'));
}

}
