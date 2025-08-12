<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = [
            [
  'title' => 'Osez Dire Non',
  'description' => 'Blog éducatif Laravel + Stripe + rôles, responsive.',
  'image' => 'images/cover-ODN.png',

  'tech' => ['Laravel','Blade','Tailwind','Stripe','SQLite'],
  'github' => 'https://github.com/sosylvie1/osezdirenon',
  'live' => null, 
  'case' => null, 
  'readme' => 'https://github.com/sosylvie1/osezdirenon#readme',

  // 👇 pour mes videos en  local
  'video' => 'videos/projets/osezdirenon-demo.mp4',     // MP4 dans public/videos/projets/
  'video_webm' => 'videos/projets/osezdirenon-demo.webm' // (optionnel)
],


            // [
            //     'title' => 'Portfolio Laravel',
            //     'description' => 'Portfolio perso (Blade, Breeze), mobile-first et accessible.',
            //     'image' => 'images/projets/portfolio-cover.jpg',
            //     'tech' => ['Laravel','Blade','Tailwind','Breeze'],
            //     'github' => 'https://github.com//portfolio',
            //     'live' => null,
            //     'case' => null,
            //     'readme' => null,
            //     'video' => null,
            //     'figma' => null,
            // ],
        ];

        $allTech = collect($projects)->pluck('tech')->flatten()->unique()->sort()->values();

        return view('projets.index', compact('projects','allTech'));
    }
}
