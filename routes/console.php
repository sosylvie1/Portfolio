<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\SitemapGenerator;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Routes sitemap
|--------------------------------------------------------------------------
*/
Artisan::command('sitemap:generate', function () {
    SitemapGenerator::create('https://portfolio.sylvie-seguinaud.fr')
        ->writeToFile(public_path('sitemap.xml'));


    $this->info('✅ Sitemap généré avec succès !');
});
