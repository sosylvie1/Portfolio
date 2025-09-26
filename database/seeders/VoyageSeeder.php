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
            ['src' => 'images/voyages/usa0R.webp',        'caption' => "La Freedom Tower à Miami : ex-centre d’accueil des réfugiés cubains… aujourd’hui, elle accueille surtout les touristes en quête de photos 📸🇨🇺"],
            ['src' => 'images/voyages/pm1R.webp',        'caption' => 'Promenade animée sur Ocean Drive, Miami Beach'],
            ['src' => 'images/voyages/usa2R.webp',       'caption' => 'Dans les Keys, à 90 miles (145km) de Cuba : le mojito m’attendait déjà 🍹😄'],
            ['src' => 'images/voyages/florida4R.webp',   'caption' => 'Port de pêche en Floride : les pélicans attendent leur pourboire en poisson 🐟🦩'],
            ['src' => 'images/voyages/floride5R.webp',   'caption' => 'Face à face avec un alligator – plus curieux que moi 🐊'],
            ['src' => 'images/voyages/floride2R.webp',   'caption' => 'En Floride, lève la tête : entre palmiers et avions, le ciel est toujours animé ✈️🌴'],
            ['src' => 'images/voyages/floride3R.webp',   'caption' => 'Ici, le “garage” c’est le mouillage : on sort le bateau comme d’autres la voiture 🚤'],
            ['src' => 'images/voyages/fortl1R.webp',   'caption' =>'Fort Lauderdale : difficile de choisir entre bronzer, nager… ou ne rien faire du tout 😎🌊'],         
            ['src' => 'images/voyages/fortl2R.webp',   'caption' =>'Fort Lauderdale :Le travail d’équipe ne s’arrête pas au chantier… il continue à table ! 👷‍♂️🍻'], 
            ['src' => 'images/voyages/fortl3R.webp',   'caption' =>'Fort Lauderdale :Travailler dur, mais trinquer plus fort : la vraie expérience américaine 🍻😅'],
            ['src' => 'images/voyages/hollywoodfl1.webp',   'caption' =>'Hollywood version Floride : ici, on roule en famille avec style… à pédales 🚲☀️'],
             ['src' => 'images/voyages/floride9.webp',   'caption' =>'Miami : entre ciel bleu, gratte-ciels et routes suspendues, même ton GPS s’y perd 🛰️😅'],
            ['src' => 'images/voyages/louisiane2R.webp', 'caption' => 'Maisons colorées du Vieux Carré à la Nouvelle-Orléans'],
            ['src' => 'images/voyages/louisiane1R.webp',   'caption' =>'En Louisiane, pas besoin de burger : ici, on décortique l’apéro avec les doigts ! 🦞🔥'], 
            ['src' => 'images/voyages/newyork3R.webp',   'caption' => 'Times Square dans le brouillard, New York vaporeuse'],
            ['src' => 'images/voyages/newyork2R.webp',   'caption' => 'Moi en mode geek chez Google – promis, je ne postule pas (pas encore) 👩‍💻'],
            ['src' => 'images/voyages/newyork4.webp',   'caption' => 'New York : même les avions ne peuvent pas résister à une photo avec l’Empire State 📸'],
            ['src' => 'images/voyages/usa13.webp',   'caption' => 'Le Texas, là où ton permis inclut option camion 38 tonnes 🚚'],
            ['src' => 'images/voyages/texas1R.webp',     'caption' => 'Route iconique au cœur du Texas – manque plus que le cowboy 🤠'],
            ['src' => 'images/voyages/texas7.webp',   'caption' => 'Texas style : quand ton jouet préféré, c’est une grue de 50 tonnes 🚜✨'],
            ['src' => 'images/voyages/texas8.webp',   'caption' => 'Ici, le passeport n’est pas le plus important… c’est ta patience ! ⏳🛂'], 
            ['src' => 'images/voyages/texas3.webp',   'caption' => 'Voodoo à Austin : un lieu où tu hésites entre commander un café… ou invoquer Elvis 👻🎸'], 
            ['src' => 'images/voyages/texas2.webp',   'caption' => 'À défaut de cow-boys à cheval, voici les cow-boys du paddle ! 🤠🏄‍♂️'], 
             ['src' => 'images/voyages/lv1R.webp',   'caption' => 'Heart Attack Grill :Infirmière souriante + ordonnance liquide = santé garantie… ou pas 😂
'], 
             
             

        ];

        foreach ($usaPhotos as $photo) {
            VoyagePhoto::updateOrCreate(
                ['voyage_id' => $usa->id, 'src' => $photo['src']],
                ['caption' => $photo['caption']]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | co Colombie
        |--------------------------------------------------------------------------
        */
        $colombie = Voyage::updateOrCreate(
            ['pays' => 'Colombie'],
            [
                'annee' => '2019',
                'photo' => 'images/voyages/colombie.jpg',
                'description' => "En 2019, j’ai effectué plusieurs déplacements en Colombie, principalement à Bogota. Ces séjours m’ont permis de mieux comprendre la dynamique culturelle et économique de ce pays.",
            ]
        );

        $colombiePhotos = [
    ['src' => 'images/voyages/colombieR.webp',   'caption' => 'Place Bolívar, Bogotá : les pigeons en conseil d’État, et moi en touriste officielle 👑🕊️'],
    ['src' => 'images/voyages/colombie1R.webp',  'caption' => 'Danse de rue entre tango et salsa : mes pieds hésitent, la musique non 💃😅'],
    ['src' => 'images/voyages/colombie2R.webp',  'caption' => 'Marché de CBD et dérivés… non, pas de weed pour moi 🙅‍♀️🌿'],
    ['src' => 'images/voyages/colombie3R.webp',  'caption' => 'Village coloré sur la montagne de Bogotá : même les maisons portent du mascara 🎨🏡'],
   
     ['src' => 'images/voyages/colombie19.webp', 'caption' => 'Étals de fromages & jambons : spécialités locales, tentation à chaque pas 🧀🥓'],
    ['src' => 'images/voyages/colombie13R.webp', 'caption' => 'Encore une cave à fromage… promis, la dernière 🧀😉'],
    ['src' => 'images/voyages/colombie20.webp', 'caption' => 'Café colombien : l’espresso qui met tout le monde d’accord ☕'],
    ['src' => 'images/voyages/colombie5R.webp',  'caption' => 'Atoll de San Andrés : carte postale en vrai 🌴🌊'],
    ['src' => 'images/voyages/colombie9R.webp',  'caption' => 'Émeraude dans la roche : la nature a de l’éclat 💎'],
    ['src' => 'images/voyages/colombie10R.webp', 'caption' => 'Émeraude de Muzo, sortie directe de la mine — j’aurais dû négocier une bague 💍'],
    ['src' => 'images/voyages/colombie11R.webp', 'caption' => 'Maïs grillé : simple, parfait, addictif 🌽🔥'],
    ['src' => 'images/voyages/colombie12R.jpg', 'caption' => 'Je n\'ai pas pu résister 😉'],
   
   
    ['src' => 'images/voyages/colombie16.webp', 'caption' => 'Allée paisible à Nemocón : respiration profonde et déclic photo 🏞️'],
    ['src' => 'images/voyages/colombie17.webp', 'caption' => 'Casque vissé, je descends dans la mine : Indiana Sylvie ⛑️⛏️'],
    ['src' => 'images/voyages/colombie18.webp', 'caption' => 'Mine de sel de Nemocón : couleurs extra, filtre Instagram naturel ✨'],
    
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
                'annee' => '2012 - 2020',
                'photo' => 'images/voyages/mexiqueR.webp',
                'description' => " Découverte d’un pays riche en contrastes. Des rencontres marquantes, des gens chaleureux, des cultures fascinantes, un quotidien parfois léger et festif, parfois dur et éprouvant.
Le travail, les efforts, les hauts et les bas… Entre les rires, les couleurs, mais aussi l’ombre des cartels et le choc du Covid, cette expérience a tout eu : intensité, imprévus et leçons de vie.
Un chapitre inoubliable, gravé dans la mémoire.",
            ]
        );

        $mexiquePhotos = [
            ['src' => 'images/voyages/mexique1R.webp', 'caption' => 'Arandas : le seul marché où un simple regard te fait transpirer 🌶️😅
'],
            ['src' => 'images/voyages/mexique2R.webp', 'caption' => '️Aguascalientes : l’endroit où même les super-héros s’inclinent devant les gorditas de Doña Lucha 💪🌮'],
            ['src' => 'images/voyages/mexique3R.webp', 'caption' => 'Au lac Chapala, les bateaux attendent les touristes… et les pélicans attendent le déjeuner
'],
            ['src' => 'images/voyages/mexique4R.webp', 'caption' => 'Arandas style : un cheval sur le toit, des selles en vitrine et du rodéo dans l’air 🎉
'],
            ['src' => 'images/voyages/mexique5R.webp', 'caption' => 'Pas de bière aujourd’hui… mais un savon Corona pour trinquer avec les bulles
'],
            ['src' => 'images/voyages/mexique6R.webp', 'caption' => 'Ici, le secret de la cuisine, c’est moins le piment que la bonne humeur 🌮😅
'],
['src' => 'images/voyages/mexique8b.webp', 'caption' => 'Arandas: Dans l’infini des champs d’agaves, seul un petit compagnon ouvre le chemin vers l’horizon azur. 🌾🐾

'],
['src' => 'images/voyages/mexique9b.webp', 'caption' => 'Arandas: Ici, pas besoin de GPS… si tu te perds, suis l’odeur des tacos, le maïs te ramènera à la civilisation ! 🌽🌮😆

'],
            ['src' => 'images/voyages/mexique7R.webp', 'caption' => 'Fiesta charra : les bottes brillent, les selles étincellent et les chevaux paradent ✨'],
            ['src' => 'images/voyages/mexique8R.webp', 'caption' => 'Arandas: Quand tu pensais sortir pour des tacos, mais que le menu du jour c’est raclette 🌮➡️🧀'],
            ['src' => 'images/voyages/mexique9R.webp', 'caption' => 'Bacalar, Quintana Roo : Quand tu viens pour voir la lagune… mais que tu restes pour le festin 🌊➡️🍤
'],
            ['src' => 'images/voyages/mexique10bR.webp', 'caption' => 'Les couvents mexicains : où même les plantes font leur retraite spirituelle 😂🌱
'],
            ['src' => 'images/voyages/mexique11bR.webp', 'caption' => 'Arandas : shopping de cowboy moderne, chariot d’un côté, sombrero de l’autre 🤠🛒'],
            ['src' => 'images/voyages/mexique12bR.webp', 'caption' => 'Puerto Vallarta, là où les maisons respirent le soleil et les fleurs ☀️🌸
'],
            ['src' => 'images/voyages/mexique12bisR.jpg', 'caption' => 'Centre-ville Mexico : quand l’électricité devient de l’art abstrait 🎨🔌
'],
 ['src' => 'images/voyages/mexique17.webp', 'caption' => 'Quand tu commandes un cheval en taille standard mais qu’on te livre l’édition XXL… il a fallu une échelle pour monter et un parachute pour descendre ! 🐎

'],
['src' => 'images/voyages/mexique13.webp', 'caption' => 'Arandas: J’étais venue pour manger… et me voilà presque en apprentie tequila master ! 🍹😅

'],
['src' => 'images/voyages/mexique14.webp', 'caption' => 'Mexico: Quand un Français pose ses couleurs sur Mexico : résultat explosif et magique 🎨🐆

'],
['src' => 'images/voyages/mexique15.webp', 'caption' => 'Mexico city: On dirait le casting mexicain de Sons of Anarchy, mais avec plus de chili et de sombreros. 🌶️🕶️
'],
['src' => 'images/voyages/mexique16.webp', 'caption' => 'Guadalajara : Ça, c’est ce que j’appelle un mur porteur… porteur de tequila et de fiesta ! 🎊🇲🇽

'],
['src' => 'images/voyages/mexique18.webp', 'caption' => 'Kohunlich :Après 200 marches, j’ai trouvé le meilleur spot…🥵⛰️😂

'],
['src' => 'images/voyages/mexique18b.webp', 'caption' => 'Vue depuis la pyramide de Kohunlich : un spot parfait pour chercher… où j’ai garé ma voiture


'],


            
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
                'photo' => 'images/voyages/cayman.jpg',
                'description' => "Voyage aux Îles Caïmans : paradis marin, plages infinies et ambiance des Caraïbes.",
            ]
        );

        $caymanPhotos = [
            ['src' => 'images/voyages/cayman.jpg', 'caption' => 'Hotel Plage de Seven Mile Beach : belle de vue 🏝️'],
            ['src' => 'images/voyages/cayman2R.webp', 'caption' => 'Plongée avec les raies : rencontre magique 🐠'],
            
            ['src' => 'images/voyages/cayman4R.webp', 'caption' => 'Quand tu pars en balade Seven Mile Beach et que ton scooter des mers refuse de bouger !" 😅☀️ '],
            
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
                'photo' => 'images/voyages/dubai.jpg',
                'description' => "Entre désert, gratte-ciel et îles artificielles, Dubaï est un mélange unique de tradition et de modernité.",
            ]
        );

        $dubaiPhotos = [
            ['src' => 'images/voyages/dubai1R.webp', 'caption' => 'Nouveau voisin'],
            ['src' => 'images/voyages/dubai2R.webp', 'caption' => 'Vue de mon balcon au 36ᵉ étage : avec la tempête de sable, on se croirait dans un remake de « Silent Hill » version désert 🌪️🏜️.e'],
            ['src' => 'images/voyages/dubai3R.webp', 'caption' => 'Burj Al Arab : l’hôtel en forme de voile ⛵, et moi coincée au souk à hésiter entre acheter des épices ou une lampe magique 🧞‍♂️✨'],
            ['src' => 'images/voyages/dubai5R.webp', 'caption' => 'Atlantis The Palm : le palace rose qui trône au bout de Palm Jumeirah – entre luxe, dauphins et toboggans géants 🏖️🐬'],
            ['src' => 'images/voyages/dubai6.webp', 'caption' => 'Pause thé sous une tente bédouine : ambiance 1001 nuits'],
            ['src' => 'images/voyages/dubai7R.webp', 'caption' => '👉 Burj Khalifa : l’immeuble tellement haut qu’on commence le café au rez-de-chaussée et on le finit au 124ᵉ étage ☕🚀.'],
            ['src' => 'images/voyages/dubai8.webp', 'caption' => 'Souk by night'],
            ['src' => 'images/voyages/dubai9.webp', 'caption' => 'Au Dubai Mall, même les mannequins font du plongeon… moi j’ai juste plongé ma carte bleue dans les boutiques 💸😂.'],
            ['src' => 'images/voyages/dubai10.webp', 'caption' => 'Dubai Marina by night, vue de mon balcon'],
            ['src' => 'images/voyages/dubai12.webp', 'caption' => 'Souk un jour, Souk toujours'],
            ['src' => 'images/voyages/dubai14.webp', 'caption' => 'Balade en abra sur le Dubai Creek : eux ont les Rolex (Rolex Towers ), moi j’ai juste pris le temps… et un coup de soleil ⏱️☀️😅'],
            
            
            
        ];

        foreach ($dubaiPhotos as $photo) {
            VoyagePhoto::updateOrCreate(
                ['voyage_id' => $dubai->id, 'src' => $photo['src']],
                ['caption' => $photo['caption']]
            );
        }
    
   /*
|--------------------------------------------------------------------------
| 📄 Documents officiels
|--------------------------------------------------------------------------
*/
$documents = Voyage::updateOrCreate(
    ['pays' => 'Documents officiels'],
    [
        'annee' => '2011 - 2020',
        'photo' => 'images/voyages/documents.jpg',
        'description' => "Carte spéciale regroupant mes documents d’identité (divorcée depuis), et permis des pays où j’ai vécu (Émirats, USA, Mexique).",
    ]
);

$documentsPhotos = [
    ['src' => 'images/voyages/documents.jpg', 'caption' => ' mon ticket d’aventure pour changer de continent ✈️'],
    
];

foreach ($documentsPhotos as $photo) {
    VoyagePhoto::updateOrCreate(
        ['voyage_id' => $documents->id, 'src' => $photo['src']],
        ['caption' => $photo['caption']]
    );
}
  }
}




