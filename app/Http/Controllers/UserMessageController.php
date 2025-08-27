<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;

class UserMessageController extends Controller
{
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
        $message = ContactMessage::where(function ($q) {
            $q->where('user_id', Auth::id())
              ->orWhere('recipient_id', Auth::id());
        })->findOrFail($id);

        return view('user.messages.show', compact('message'));
    }

    /**
     * ❌ Supprimer un message (soft delete)
     */
    public function destroy($id)
    {
        $message = ContactMessage::where(function ($q) {
            $q->where('user_id', Auth::id())
              ->orWhere('recipient_id', Auth::id());
        })->findOrFail($id);

        $message->delete();

        return redirect()->back()->with('success', 'Message supprimé avec succès.');
    }
    /**
 * 🔄 Restaurer un message supprimé (soft delete)
 */
public function restore($id)
{
    $message = \App\Models\ContactMessage::onlyTrashed()
        ->where('user_id', \Auth::id())
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
    $message = \App\Models\ContactMessage::onlyTrashed()
        ->where('user_id', \Auth::id())
        ->findOrFail($id);

    $message->forceDelete();

    return redirect()->route('messages.supprimes')
        ->with('success', 'Message supprimé définitivement.');
}

}
