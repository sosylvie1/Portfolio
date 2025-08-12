<?php

namespace App\Http\Controllers;

class CvController extends Controller
{
    private string $cvPath;

    public function __construct()
    {
        $this->cvPath = storage_path('app/private/cv/CV_Sylvie_Seguinaud.pdf');
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

    // Téléchargement protégé (auth requis)
    public function download()
    {
        $path = storage_path('app/private/cv/CV_Sylvie_Seguinaud.pdf');

        if (!file_exists($path)) {
            abort(404, 'CV introuvable.');
        }

        return response()->download($path, 'CV_Sylvie_Seguinaud.pdf');
    }
}

