<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voyage;

class VoyageSeeder extends Seeder
{
    public function run(): void
    {
        Voyage::firstOrCreate([
            'pays' => 'Dubai',
            'annee' => '2011 - 2012',
             'photo' => 'images/voyages/dubai.jpg',
             //si j ai plusieurs photos idem a faire pour les autres
        //     'photos' => json_encode([
        // 'images/voyages/dubai1.jpg',
        // 'images/voyages/dubai2.jpg',
        // 'images/voyages/dubai3.jpg'
    // ]),
            'description' => 'De 2011 à 2012, j’ai vécu à Dubaï en tant que résidente et professionnelle active. Ces années m’ont offert une immersion unique dans un environnement international en pleine expansion, au cœur des Émirats Arabes Unis.'
        ]);

        Voyage::firstOrCreate([
            'pays' => 'États-Unis',
            'annee' => '2013 - 2020',
            'photo' => 'images/voyages/usa.jpg',
            'description' => 'Entre 2013 et 2020, j’ai résidé aux États-Unis, principalement en Floride et au Texas. Ce séjour long terme m’a permis de développer une expérience professionnelle riche tout en m’imprégnant de la diversité culturelle américaine.'
        ]);

        Voyage::firstOrCreate([
            'pays' => 'Mexique',
            'annee' => '2014 - 2020',
            'photo' => 'images/voyages/mexique.jpg',
            'description' => 'De 2014 à 2020, j’ai également vécu et travaillé au Mexique, notamment à Aguascalientes, Jalisco et Tamaulipas. Une immersion profonde dans la culture locale, marquée par de nombreux déplacements professionnels.'
        ]);

        Voyage::firstOrCreate([
            'pays' => 'Colombie',
            'annee' => '2019',
            'photo' => 'images/voyages/colombie.jpg',
            'description' => 'En 2019, j’ai effectué plusieurs déplacements en Colombie, principalement à Bogota. Ces séjours m’ont permis de mieux comprendre la dynamique culturelle et économique de ce pays.'
        ]);

        Voyage::firstOrCreate([
            'pays' => 'Îles Caïmans',
            'annee' => '2011',
            'photo' => 'images/voyages/cayman.jpg',
            'description' => 'En 2011, j’ai eu l’opportunité de séjourner aux Îles Caïmans. Cette expérience dans un cadre exceptionnel a enrichi mon parcours international d’une touche caribéenne unique.'
        ]);
        Voyage::firstOrCreate(
   [
    'pays' => 'Documents officiels',
    'annee' => '2011 - 2020',
    'photo' => 'images/voyages/documents.png',
    'description' => 'Carte spéciale regroupant mes documents d’identité et permis des pays où j’ai vécu (Émirats, USA, Mexique).'
]);



    }
}
