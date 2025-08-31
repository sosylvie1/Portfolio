<?php


   namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    protected $fillable = ['pays', 'annee', 'photo', 'photos', 'description'];

    protected $casts = [
        'photos' => 'array',
    ];
}



