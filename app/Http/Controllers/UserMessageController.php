<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;

class UserMessageController extends Controller
{
    /**
     * ✉️ Formulaire nouveau message
     */
    public function create()
    {
        return view('user.messages.create');
    }

    /**
     * 📑 Page d'accueil des messages (index)
     */
    public function index()
    {
        $user = Auth::user();

        // Tous les messages (reçus + envoyés)
        $messages = ContactMessage::where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('recipient_id', $user->id);
            })
            ->latest()
            ->get();

        // Messages envoyés
        $sentMessages = ContactMessage::where('user_id', $user->id)
            ->latest()
            ->get();

        // Messages reçus
        $receivedMessages = ContactMessage::where('recipient_id', $user->id)
            ->latest()
            ->get();

        return view('user.messages.index', compact('messages', 'sentMessages', 'receivedMessages'));
    }

    /**
     * 📩 Envoi d’un nouveau message
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:5',
        ]);

        // Enregistrement en base
        $message = ContactMessage::create([
            'company_name' => null,
            'name'         => Auth::user()->name,
            'email'        => Auth::user()->email,
            'subject'      => $validated['subject'] ?? null,
            'message'      => $validated['message'],
            'user_id'      => Auth::id(),
            'recipient_id' => 1, // ⚡ ID admin
            'is_read'      => 0,
            'status'       => 'sent',
        ]);

        // Envoi du mail vers la boîte Roundcube
        Mail::to('contact@sylvie-seguinaud.fr')
            ->send(new ContactMessageMail($message));

        return redirect()->route('messages.envoyes')
                         ->with('success', '✅ Votre message a bien été envoyé et transmis par mail.');
    }

    /**
     * 📤 Messages envoyés
     */
    public function sent()
    {
        $messages = ContactMessage::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('user.messages.sent', compact('messages'));
    }

    /**
     * 📥 Messages reçus
     */
    public function received()
    {
        $messages = ContactMessage::where('recipient_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('user.messages.received', compact('messages'));
    }

    /**
     * 🗑️ Messages supprimés
     */
    public function deleted()
    {
        $messages = ContactMessage::onlyTrashed()
            ->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhere('recipient_id', Auth::id());
            })
            ->orderByDesc('deleted_at')
            ->get();

        return view('user.messages.deleted', compact('messages'));
    }

    /**
     * 👁️ Voir un message
     */
    public function show($id)
    {
        $message = ContactMessage::withTrashed()
            ->where('id', $id)
            ->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhere('recipient_id', Auth::id());
            })
            ->firstOrFail();

        // Marquer comme lu si je suis le destinataire
        if ($message->recipient_id === Auth::id() && !$message->is_read) {
            $message->update(['is_read' => 1]);
        }

        return view('user.messages.show', compact('message'));
    }

    /**
     * 📌 Marquer un message comme lu
     */
    public function mark($id)
    {
        $message = ContactMessage::where('recipient_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $message->update(['is_read' => 1]);

        return back()->with('success', 'Message marqué comme lu.');
    }

    /**
     * 📧 Répondre à un message
     */
    public function reply(Request $request, $id)
    {
        $validated = $request->validate([
            'reply' => 'required|string|min:3',
        ]);

        $original = ContactMessage::where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhere('recipient_id', Auth::id());
            })
            ->where('id', $id)
            ->firstOrFail();

        // Sauvegarde en base
        $reply = ContactMessage::create([
            'company_name' => 'Utilisateur',
            'name'         => Auth::user()->name,
            'email'        => Auth::user()->email,
            'subject'      => 'Réponse : ' . ($original->subject ?? 'Sans sujet'),
            'message'      => $validated['reply'],
            'user_id'      => Auth::id(),
            'recipient_id' => 1, // ⚡ id admin
            'is_read'      => 0,
            'status'       => 'sent',
        ]);

        // Envoi du mail vers la boîte Roundcube
        Mail::to('contact@sylvie-seguinaud.fr')
            ->send(new ContactMessageMail($reply));

        return redirect()->route('messages.envoyes')
                         ->with('success', '✅ Réponse envoyée et transmise par mail.');
    }

    /**
     * ❌ Supprimer un message (soft delete)
     */
    public function destroy($id)
    {
        $message = ContactMessage::where('id', $id)
            ->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhere('recipient_id', Auth::id());
            })
            ->firstOrFail();

        $message->delete();

        return redirect()->route('messages.supprimes')
                         ->with('success', 'Message supprimé avec succès.');
    }

    /**
     * 🔄 Restaurer un message supprimé
     */
    public function restore($id)
    {
        $message = ContactMessage::onlyTrashed()
            ->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhere('recipient_id', Auth::id());
            })
            ->findOrFail($id);

        $message->restore();

        return redirect()->route('messages.supprimes')
                         ->with('success', 'Message restauré avec succès.');
    }

    /**
     * ❌ Supprimer définitivement un message
     */
    public function forceDelete($id)
    {
        $message = ContactMessage::onlyTrashed()
            ->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhere('recipient_id', Auth::id());
            })
            ->findOrFail($id);

        $message->forceDelete();

        return redirect()->route('messages.supprimes')
                         ->with('success', 'Message supprimé définitivement.');
    }
}
