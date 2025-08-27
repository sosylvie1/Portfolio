<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvDownload extends Model
{
    protected $fillable = ['user_id', 'downloaded_at'];
    public $timestamps = false;

    // Cast pour manipuler downloaded_at comme un objet Carbon
    protected $casts = [
        'downloaded_at' => 'datetime',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
