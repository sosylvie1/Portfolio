<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Affiche la liste de tous les projets du portfolio
     * (et gère l’accès aux maquettes Figma directement).
     */
    public function index()
    {
        $projects = Project::all();
        return view('projets.index', compact('projects'));
    }
}

