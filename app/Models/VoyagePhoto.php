<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// chaque photo appartient à un voyage
class VoyagePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'voyage_id',
        'src',
        'caption',
    ];

    public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }
}
