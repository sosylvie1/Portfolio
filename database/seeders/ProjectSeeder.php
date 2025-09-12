<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Portfolio Laravel
        Project::updateOrCreate(
            ['slug' => 'portfolio-laravel'],
            [
                'title' => 'Portfolio Laravel',
                'description' => 'Un portfolio technique mais aussi le reflet d’un parcours international.',
                'image' => 'images/projects/cover-portfolio.png',
                'tech' => ['Laravel', 'Blade', 'Tailwind', 'AlpineJS'],
                'github' => 'https://github.com/sosylvie1/portfolio',
                'live' => 'https://sylvie-seguinaud.fr',
                'date' => '2025-09-01',
                'is_published' => true,
                'order' => 1,
            ]
        );

        // Blog éducatif
        Project::updateOrCreate(
            ['slug' => 'osezdirenon'],
            [
                'title' => 'Osez-Dire-Non',
                'description' => 'Blog participatif avec rôles, publicité payante et modération.',
                'image' => 'images/projects/cover-ODN.png',
                'tech' => ['Laravel', 'Blade', 'Tailwind CSS', 'Stripe'],
                'github' => 'https://github.com/sosylvie1/OsezDireNon',
                'readme' => 'https://github.com/sosylvie1/OsezDireNon#readme',
                // 'live' => 'https://osezdirenon.fr',
                'figma_images' => [
                    'images/projects/figma/blog-figma-1.png',
                    'images/projects/figma/blog-figma-2.png',
                    'images/projects/figma/blog-figma-3.png',
                    'images/projects/figma/blog-figma-4.png',
                ],
                'date' => '2025-06-01',
                'is_published' => true,
                'order' => 2,
            ]
        );

        // Mamie4Family
        Project::updateOrCreate(
            ['slug' => 'mamie4family'],
            [
                'title' => 'Mamie4Family',
                'description' => 'Plateforme reliant familles et mamies à louer pour occasions spéciales, en cours de développement (dont la réservation à implémenter).',
                'image' => 'images/projects/mamie4family.png',
                'tech' => ['PHP', 'MySQL', 'HTML', 'CSS'],
                'github' => 'https://github.com/sosylvie1/Mamie4Family',
                'readme' => 'https://github.com/sosylvie1/Mamie4Family#readme',
                
                'figma_images' => [
                    'images/projects/figma/mamie4family-figma-1.png',
                    'images/projects/figma/mamie4family-figma-2.png',
                    'images/projects/figma/mamie4family-figma-3.png',
                ],
                'date' => '2024-12-01',
                'is_published' => true,
                'order' => 3,
            ]
        );
        // Clone Netflix
        Project::updateOrCreate(
            ['slug' => 'clonenetflix'],
            [
                'title' => 'Clone Netflix',
                'description' => 'Ce projet est un clone simplifié de Netflix, réalisé en novembre 2024 dans le cadre de ma formation en développement web (DWWM).',
                'image' => 'images/projects/cover-netflix.webp',
                'tech' => ['React (v18)', 'Create React App', 'HTML', 'CSS3', 'JavaScript'],
                'github' => 'https://github.com/sosylvie1/netflix',
                'readme' => 'https://github.com/sosylvie1/netflix#readme',
                'date' => '2024-11-11',
                'is_published' => true,
                'order' => 4,
            ]
        );
    }
}
