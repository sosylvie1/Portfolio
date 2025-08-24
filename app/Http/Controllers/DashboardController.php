<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Si admin → redirect vers le dashboard admin
        if ($user && $user->role === 1) {
            return redirect()->route('admin.dashboard');
        }

        // Sinon → vue utilisateur
        return view('user.dashboard');
    }
}
