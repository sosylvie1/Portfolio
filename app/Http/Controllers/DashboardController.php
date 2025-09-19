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

        // ✅ Toujours définir la variable (même si null)
        // $lastCvDownload = $user->lastCvDownload;
        $lastCvDownload = $user->lastCvDownload ?? null;

        return view('user.dashboard', compact('user', 'lastCvDownload'));
    }
}
