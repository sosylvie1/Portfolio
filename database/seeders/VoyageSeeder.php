<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voyage;
use App\Models\VoyagePhoto;

class VoyageSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 🇺🇸 États-Unis
        |--------------------------------------------------------------------------
        */
        $usa = Voyage::updateOrCreate(
            ['pays' => 'États-Unis'],
            [
                'annee' => '2013 - 2020',
                'photo' => 'images/voyages/usa.webp',
                'description' => 'Entre 2013 et 2020, j’ai résidé aux États-Unis, principalement en Floride et au Texas. Ce séjour long terme m’a permis de développer une expérience professionnelle riche tout en m’imprégnant de la diversité culturelle américaine.',
            ]
        );

        $usaPhotos = [
            ['src' => 'images/voyages/usa0.webp',        'caption' => "La Freedom Tower à Miami : ex-centre d’accueil des réfugiés cubains… aujourd’hui, elle accueille surtout les touristes en quête de photos 📸🇨🇺"],
            ['src' => 'images/voyages/pm1.webp',        'caption' => 'Promenade animée sur Ocean Drive, Miami Beach'],
            ['src' => 'images/voyages/usa2.webp',       'caption' => 'Dans les Keys, à 90 miles (145km) de Cuba : le mojito m’attendait déjà 🍹😄'],
            ['src' => 'images/voyages/florida4.webp',   'caption' => 'Port de pêche en Floride : les pélicans attendent leur pourboire en poisson 🐟🦩'],
            ['src' => 'images/voyages/floride5.webp',   'caption' => 'Face à face avec un alligator – plus curieux que moi 🐊'],
            ['src' => 'images/voyages/floride2.webp',   'caption' => 'En Floride, lève la tête : entre palmiers et avions, le ciel est toujours animé ✈️🌴'],
            ['src' => 'images/voyages/floride3.webp',   'caption' => 'Ici, le “garage” c’est le mouillage : on sort le bateau comme d’autres la voiture 🚤'],
            ['src' => 'images/voyages/louisiane2.webp', 'caption' => 'Maisons colorées du Vieux Carré à la Nouvelle-Orléans'],
            ['src' => 'images/voyages/texas1.webp',     'caption' => 'Route iconique au cœur du Texas – manque plus que le cowboy 🤠'],
            ['src' => 'images/voyages/newyork3.webp',   'caption' => 'Times Square dans le brouillard, New York vaporeuse'],
            ['src' => 'images/voyages/newyork2.webp',   'caption' => 'Moi en mode geek chez Google – promis, je ne postule pas (pas encore) 👩‍💻'],
        ];

        foreach ($usaPhotos as $photo) {
            VoyagePhoto::updateOrCreate(
                ['voyage_id' => $usa->id, 'src' => $photo['src']],
                ['caption' => $photo['caption']]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 🇨🇴 Colombie
        |--------------------------------------------------------------------------
        */
        $colombie = Voyage::updateOrCreate(
            ['pays' => 'Colombie'],
            [
                'annee' => '2019',
                'photo' => 'images/voyages/colombie.webp',
                'description' => "En 2019, j’ai effectué plusieurs déplacements en Colombie, principalement à Bogota. Ces séjours m’ont permis de mieux comprendre la dynamique culturelle et économique de ce pays.",
            ]
        );

        $colombiePhotos = [
            ['src' => 'images/voyages/colombie.webp',   'caption' => 'Place Bolívar, Bogotá : les pigeons en conseil d’État, et moi en touriste officielle 👑🕊️'],
            ['src' => 'images/voyages/colombie1.webp',  'caption' => 'Danse de rue entre tango et salsa : mes pieds hésitent, la musique non 💃😅'],
            ['src' => 'images/voyages/colombie2.webp',  'caption' => 'Marché de CBD et dérivés… non, pas de weed pour moi 🙅‍♀️🌿'],
            ['src' => 'images/voyages/colombie3.webp',  'caption' => 'Village coloré sur la montagne de Bogotá : même les maisons portent du mascara 🎨🏡'],
            ['src' => 'images/voyages/colombie4.webp',  'caption' => 'Cave à fromage… j’aurais bien emménagé 🧀😋'],
            ['src' => 'images/voyages/colombie5.webp',  'caption' => 'Atoll de San Andrés : carte postale en vrai 🌴🌊'],
            ['src' => 'images/voyages/colombie9.webp',  'caption' => 'Émeraude dans la roche : la nature a de l’éclat 💎'],
            ['src' => 'images/voyages/colombie10.webp', 'caption' => 'Émeraude de Muzo, sortie directe de la mine — j’aurais dû négocier une bague 💍'],
            ['src' => 'images/voyages/colombie11.webp', 'caption' => 'Maïs grillé : simple, parfait, addictif 🌽🔥'],
            ['src' => 'images/voyages/colombie13.webp', 'caption' => 'Encore une cave à fromage… promis, la dernière 🧀😉'],
            ['src' => 'images/voyages/colombie16.webp', 'caption' => 'Allée paisible à Nemocón : respiration profonde et déclic photo 🏞️'],
            ['src' => 'images/voyages/colombie17.webp', 'caption' => 'Casque vissé, je descends dans la mine : Indiana Sylvie ⛑️⛏️'],
            ['src' => 'images/voyages/colombie18.webp', 'caption' => 'Mine de sel de Nemocón : couleurs extra, filtre Instagram naturel ✨'],
            ['src' => 'images/voyages/colombie19.webp', 'caption' => 'Étals de fromages & jambons : spécialités locales, tentation à chaque pas 🧀🥓'],
            ['src' => 'images/voyages/colombie20.webp', 'caption' => 'Café colombien : l’espresso qui met tout le monde d’accord ☕'],
            ['src' => 'images/voyages/colombie21.webp', 'caption' => 'Gâteaux au cannabis médical : j’ai essayé une fois… plus jamais 🤯'],
            ['src' => 'images/voyages/colombie22.webp', 'caption' => 'Au marché : les fameux gâteaux Tres Leches, douceur fatale 🍰'],
            ['src' => 'images/voyages/colombie23.webp', 'caption' => 'Morgan’s Cave : rhum & contrebande — j’ai bien cherché le trésor 🏴‍☠️🍾'],
        ];

        foreach ($colombiePhotos as $photo) {
            VoyagePhoto::updateOrCreate(
                ['voyage_id' => $colombie->id, 'src' => $photo['src']],
                ['caption' => $photo['caption']]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 🇲🇽 Mexique
        |--------------------------------------------------------------------------
        */
        $mexique = Voyage::updateOrCreate(
            ['pays' => 'Mexique'],
            [
                'annee' => '2012',
                'photo' => 'images/voyages/mexique.webp',
                'description' => "Séjour inoubliable au Mexique, entre sites mayas, plages de sable blanc et ambiance festive.",
            ]
        );

        $mexiquePhotos = [
            ['src' => 'images/voyages/mexique1.webp', 'caption' => 'Chichen Itza : les pyramides qui défient le temps ⛩️'],
            ['src' => 'images/voyages/mexique2.webp', 'caption' => 'Plage de Cancún : eau turquoise et sable blanc 🏖️'],
            ['src' => 'images/voyages/mexique3.webp', 'caption' => 'Mariachis dans les rues : musique et sourire garantis 🎺'],
        ];

        foreach ($mexiquePhotos as $photo) {
            VoyagePhoto::updateOrCreate(
                ['voyage_id' => $mexique->id, 'src' => $photo['src']],
                ['caption' => $photo['caption']]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 🇰🇾 Îles Caïmans
        |--------------------------------------------------------------------------
        */
        $cayman = Voyage::updateOrCreate(
            ['pays' => 'Îles Caïmans'],
            [
                'annee' => '2014',
                'photo' => 'images/voyages/cayman.webp',
                'description' => "Voyage aux Îles Caïmans : paradis marin, plages infinies et ambiance des Caraïbes.",
            ]
        );

        $caymanPhotos = [
            ['src' => 'images/voyages/cayman1.webp', 'caption' => 'Plage de Seven Mile Beach : sable fin à perte de vue 🏝️'],
            ['src' => 'images/voyages/cayman2.webp', 'caption' => 'Plongée avec les raies : rencontre magique 🐠'],
            ['src' => 'images/voyages/cayman3.webp', 'caption' => 'Coucher de soleil caribéen : explosion de couleurs 🌅'],
        ];

        foreach ($caymanPhotos as $photo) {
            VoyagePhoto::updateOrCreate(
                ['voyage_id' => $cayman->id, 'src' => $photo['src']],
                ['caption' => $photo['caption']]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 🇦🇪 Dubaï
        |--------------------------------------------------------------------------
        */
        $dubai = Voyage::updateOrCreate(
            ['pays' => 'Dubaï'],
            [
                'annee' => '2011 - 2012',
                'photo' => 'images/voyages/dubai.webp',
                'description' => "Entre désert, gratte-ciel et îles artificielles, Dubaï est un mélange unique de tradition et de modernité.",
            ]
        );

        $dubaiPhotos = [
            ['src' => 'images/voyages/dubai1.webp', 'caption' => 'Burj Khalifa : la tête dans les nuages 🌆'],
            ['src' => 'images/voyages/dubai2.webp', 'caption' => 'Safari dans le désert : sensations fortes garanties 🏜️'],
            ['src' => 'images/voyages/dubai3.webp', 'caption' => 'Palm Jumeirah : l’île en forme de palmier 🌴'],
        ];

        foreach ($dubaiPhotos as $photo) {
            VoyagePhoto::updateOrCreate(
                ['voyage_id' => $dubai->id, 'src' => $photo['src']],
                ['caption' => $photo['caption']]
            );
        }
    }
}
