<?php


   namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
     * voyage peut avoir plusieurs photos associées.
     */

class Voyage extends Model
{
    use HasFactory;

    protected $fillable = [
        'pays',
        'annee',
        'photo',
        'description',
    ];

    /**
     * Relation : un voyage possède plusieurs photos
     */
    public function photos()
    {
        return $this->hasMany(VoyagePhoto::class);
    }
}



