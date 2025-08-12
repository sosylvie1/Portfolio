<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Page d’accueil
     */
    public function accueil()
    {
        return view('pages.accueil'); // Crée resources/views/pages/accueil.blade.php
    }

    /**
     * Page à propos
     */
    public function aPropos()
    {
        return view('pages.a-propos'); // Crée resources/views/pages/a-propos.blade.php
    }

    /**
     * Page projets publics
     */
    public function projets()
    {
        return view('pages.projets'); // Crée resources/views/pages/projets.blade.php
    }
}
