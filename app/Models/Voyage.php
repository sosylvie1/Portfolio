<?php


   namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    protected $fillable = ['pays', 'annee', 'photo', 'description', 'photos'];

    protected $casts = [
        'photos' => 'array',
    ];
}





