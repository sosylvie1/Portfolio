<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function show($id)
    {
        return "Afficher l'utilisateur $id";
    }

    public function destroy($id)
    {
        return "Supprimer l'utilisateur $id";
    }
}



