<?php

namespace App\Http\Controllers;

use App\Models\CvDownload;       // ✅ importe bien le modèle
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CvController extends Controller
{
    private string $cvPath;

    public function __construct()
    {
        // On met le CV dans storage/app/private/cv/
        $this->cvPath = storage_path('app/private/cv/CV_Sylvie_Seguinaud.pdf');
    }
    public function index(Request $request)
    {
        $user = $request->user();
        $lastCvDownload = $user ? $user->lastCvDownload : null;

        return view('user.cv', compact('lastCvDownload'));
    }

    // Page publique avec aperçu
    public function show()
    {
        return view('pages.cv');
    }

    // Aperçu PDF accessible à tous
    public function preview()
    {
        abort_unless(file_exists($this->cvPath), 404, 'CV introuvable');

        return response()->file($this->cvPath, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="CV_Sylvie_Seguinaud.pdf"',
        ]);
    }

    // Téléchargement réservé aux utilisateurs connectés
    public function download()
    {
        abort_unless(file_exists($this->cvPath), 404, 'CV introuvable');

        // Enregistrer le téléchargement dans la table cv_downloads
        CvDownload::create([
            'user_id'      => Auth::id(),
            'downloaded_at'=> now(),
        ]);

        return response()->download($this->cvPath, 'CV_Sylvie_Seguinaud.pdf');
    }
}
