<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProjectController extends Controller
{
    /**
     * Retourne la liste des projets (utilisable partout).
     */
    public static function allProjects(): array
    {
        return collect([
            [
                'date'=> '2025-06',
                'title' => 'Osez Dire Non',
                'description' => 'Blog participatif, éducatif et engagé, système de rôles et espace publicitaire payant',
                'image' => 'images/cover-ODN.png',
                'tech' => ['Laravel','Blade','Tailwind','Stripe','SQLite'],
                'github' => 'https://github.com/sosylvie1/osezdirenon',
                'live' => null,
                'case' => null,
                'readme' => 'https://github.com/sosylvie1/osezdirenon#readme',
                'video' => 'videos/projets/osezdirenon-demo.mp4',
                'video_webm' => 'videos/projets/osezdirenon-demo.webm',
                'figma_images' => [
                    'images/blog-figma-1.png',
                    'images/blog-figma-3.png',
                    'images/blog-figma-4.png',
                ],
            ],
            [
                'date'=> '2024-12',
                'title' => 'Mamie4Family',
                'description' => 'Plateforme mettant en relation familles et mamies, en cours de développement (réservation à implémenter).',
                'image' => 'images/mamie4family.png',
                'tech' => ['PHP', 'MySQL', 'HTML', 'CSS'],
                'github' => 'https://github.com/sosylvie1/MamyFamily', 
                'readme' => 'https://github.com/sosylvie1/MamyFamily#readme',
                'video' => 'videos/projets/mamie4family-demo.mp4',
                'video_webm' => 'videos/projets/mamie4family-demo.webm',
                'figma_images' => [
                    'images/mamie4family-figma-1.png',
                    'images/mamie4family-figma-2.png',
                    'images/mamie4family-figma-3.png',
                ],
            ],
        ])
        ->map(function ($p) {
            // normalise YYYY-MM
            $p['date'] = substr($p['date'] ?? '', 0, 7);
            return $p;
        })
        ->sortByDesc('date')   // tri par date décroissante
        ->values()
        ->all();
    }

    /**
     * Page publique liste des projets
     */
    public function index()
    {
        $projects = self::allProjects();

        $allTech = collect($projects)
            ->pluck('tech')
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        return view('projets.index', compact('projects', 'allTech'));
    }
}
