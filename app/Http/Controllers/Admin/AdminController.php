<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjectController;
use App\Models\User;
use App\Models\ContactMessage;

class AdminController extends Controller
{
    public function dashboard()
    {
        // $projects = ProjectController::allProjects();
        $projects = \App\Models\Project::all();


        $totalUsers    = User::count();
        $totalMessages = ContactMessage::count();
        $totalProjects = count($projects);

        return view('admin.dashboard', compact(
            'projects', 'totalUsers', 'totalMessages', 'totalProjects'
        ));
    }
}


