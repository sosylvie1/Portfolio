<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Mail\ContactReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    /**
     * 📥 Liste des messages
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return view('admin.contacts.index', compact('messages'));
    }

    /**
     * 👁️ Affiche un message et le marque lu si nécessaire
     */
    public function show(ContactMessage $message) // 🔥 route model binding
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true, 'status' => 'lu']);
        }

        return view('admin.contacts.show', compact('message'));
    }

    /**
     * ✅ Marque un message comme lu
     */
    public function markAsRead(ContactMessage $message)
    {
        $message->update(['is_read' => true, 'status' => 'lu']);

        return back()->with('success', 'Message marqué comme lu.');
    }

    /**
     * ❌ Marque un message comme non lu
     */
    public function markAsUnread(ContactMessage $message)
    {
        $message->update(['is_read' => false, 'status' => 'nouveau']);

        return back()->with('success', 'Message marqué comme non lu.');
    }

    /**
     * ✉️ Répondre à un message (mail + update DB)
     */
    public function reply(Request $request, ContactMessage $message)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $replyContent = $request->input('reply');

        // Envoi du mail
        Mail::to($message->email)->send(new ContactReplyMail($message, $replyContent));

        // Mise à jour du statut
        $message->update([
            'status'  => 'répondu',
            'is_read' => true,
        ]);

        return redirect()
            ->route('admin.contacts.show', $message->id)
            ->with('success', '✉️ Réponse envoyée à ' . $message->name);
    }

    /**
     * 🗑️ Supprime un message (soft delete si activé)
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Le message a été supprimé.');
    }
}
