<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['etape_id', 'path', 'legend'];

    public function etape()
    {
        return $this->belongsTo(Etape::class);
    }
}
