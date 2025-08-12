<?php

// app/Http/Controllers/Admin/ContactAdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactAdminController extends Controller
{
    public function index(Request $request)
    {
        $q = ContactMessage::query()
            ->when($request->boolean('unread'), fn($qq)=>$qq->where('is_read', false))
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
        return back()->with('success', $message->is_read ? 'Marqué comme lu.' : 'Marqué comme non lu.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Message supprimé.');
    }
}
