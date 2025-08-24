<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjectController as PublicProjectController;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = PublicProjectController::allProjects();
        return view('admin.projets.index', compact('projects'));
    }
}
