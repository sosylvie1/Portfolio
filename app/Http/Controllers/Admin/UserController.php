<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Liste tous les utilisateurs
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Affiche le détail d’un utilisateur
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Supprime un utilisateur
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // ⚠️ option : empêcher de supprimer l’admin principal
        if ($user->role === 'admin') {
            return redirect()->route('users.index')
                ->with('error', "Impossible de supprimer un administrateur.");
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', "Utilisateur supprimé avec succès.");
    }
}



