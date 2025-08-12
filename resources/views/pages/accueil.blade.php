@extends('layouts.app')

@section('content')
<section class="bg-pink-50 py-16 px-4">
    <div class="max-w-6xl mx-auto flex flex-col-reverse md:flex-row items-center gap-10">

        {{-- Texte d'accueil --}}
        <div class="md:w-1/2 text-center md:text-left space-y-6">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight text-gray-800">
                 Reconvertie, rechargée, redéployée.
                           </h1>


            <p class="text-pink-600 font-medium text-lg italic mt-2">
    À 63 ans, j’ai relevé le défi du numérique. Et je suis prête à relever les vôtres.
</p>

            <div class="space-y-4 text-gray-700 text-base leading-relaxed">
                <p>Une reconversion engagée, née d'un parcours personnel riche. Après avoir vécu en France, aux États-Unis, au Mexique, aux Émirats arabes unis et au Liban, j'ai développé une ouverture d'esprit et un regard pluriel sur les réalités humaines.</p>

                <p>Le passage de la soixantaine et les bouleversements liés au Covid ont rendu le retour à l'emploi difficile. J'ai alors choisi de me reconvertir dans le développement web à travers une formation intensive de 13 mois.</p>

                <p>Ce site n'est pas seulement un portfolio de code : c'est un carnet de voyage, un miroir de mes projets, de mes expériences et de mes passions. Vous y trouverez mes réalisations, mes compétences et des morceaux choisis de mon parcours de vie.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 mt-6">
                <a href="{{ route('projets.index') }}"
                   class="block w-full sm:w-auto bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-lg font-medium shadow transition text-center">
                    Découvrir mes projets
                </a>

                {{-- <a href="{{ asset('documents/CV-sylvie.pdf') }}" target="_blank"
                   class="block w-full sm:w-auto bg-gray-800 hover:bg-gray-900 text-white px-6 py-3 rounded-lg font-medium shadow transition text-center">
                    Télécharger mon CV
                </a> --}}
            </div>
        </div>
        {{-- Image portrait --}}
        <div class="md:w-1/2">
            <img src="{{ asset('images/sylvie1.jpg') }}" alt="Portrait Sylvie Seguinaud"
                 class="w-full h-auto rounded-xl shadow-xl object-cover">
        </div>

    </div>
</section>
@endsection
