<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactReplyMail;
use Illuminate\Support\Facades\Mail;

class ContactAdminController extends Controller
{
    public function index(Request $request)
    {
        $q = ContactMessage::query()
            ->when($request->boolean('unread'), fn($qq) => $qq->where('is_read', false))
            ->latest();

        $messages = $q->paginate(12)->withQueryString();

        return view('admin.contacts.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.contacts.show', compact('message'));
    }

    public function mark(ContactMessage $message)
    {
        $message->update(['is_read' => ! $message->is_read]);

        return back()->with(
            'success',
            $message->is_read ? 'Marqué comme lu.' : 'Marqué comme non lu.'
        );
    }

    public function destroy(ContactMessage $message)
    {
        // Si tu veux soft delete → garder comme ça :
        $message->delete();

        // Si tu veux supprimer définitivement :
        // $message->forceDelete();

        return redirect()->route('admin.contacts.index')
                         ->with('success', 'Message supprimé.');
    }

    public function reply(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'reply' => 'required|string|min:3',
        ]);

        // Enregistre la réponse dans la base
        ContactMessage::create([
            'company_name' => 'Administration',
            'name'         => 'Sylvie (Admin)',
            'email'        => 'contact@sylvie-seguinaud.fr', // expéditeur
            'subject'      => 'Réponse : ' . ($message->subject ?? 'Sans sujet'),
            'message'      => $validated['reply'],
            'user_id'      => Auth::id(),          // expéditeur = admin
            'recipient_id' => $message->user_id,   // destinataire = user
            'is_read'      => 0,                   // non lu par défaut
        ]);

        // Envoi aussi par email
        Mail::to($message->email)->send(
            new ContactReplyMail($validated['reply'], $message)
        );

        return redirect()->route('admin.contacts.index')
                 ->with('success', '✅ Réponse envoyée avec succès à ' . $message->name);

    }
}
