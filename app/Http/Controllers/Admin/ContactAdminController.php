<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactAdminController extends Controller
{
    /**
     * Liste des messages (tous les utilisateurs)
     */
    public function index(Request $request)
    {
        $q = ContactMessage::query()
            ->when($request->boolean('unread'), fn($qq) => $qq->where('is_read', false))
            ->latest();

        $messages = $q->paginate(12)->withQueryString();

        return view('admin.contacts.index', compact('messages'));
    }

    /**
     * Détail d’un message
     */
    public function show(ContactMessage $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.contacts.show', compact('message'));
    }

    /**
     * Marquer / dé-marquer comme lu
     */
    public function mark(ContactMessage $message)
    {
        $message->update(['is_read' => ! $message->is_read]);

        return back()->with(
            'success',
            $message->is_read ? 'Marqué comme lu.' : 'Marqué comme non lu.'
        );
    }

    /**
     * Suppression définitive d’un message
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.contacts.index')
                         ->with('success', 'Message supprimé définitivement.');
    }

    /**
     * Répondre à un utilisateur (optionnel)
     * -> Cela crée un "received" côté user
     */
    public function reply(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'reply' => 'required|string|min:3',
        ]);

        ContactMessage::create([
            'company_name' => 'Administration',
            'name'         => 'Sylvie (Admin)',
            'email'        => 'contact@sylvieseguinaud.fr',
            'subject'      => 'Réponse : ' . ($message->subject ?? 'Sans sujet'),
            'message'      => $validated['reply'],
            'user_id'      => $message->user_id,
            'status'       => 'received', // 🟢 côté user
        ]);

        return redirect()->route('admin.contacts.show', $message->id)
                         ->with('success', 'Réponse envoyée à l’utilisateur.');
    }
}
