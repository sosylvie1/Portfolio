<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{
    protected $fillable = [
        'user_id','session_id','ip','user_agent',
        'functional','analytics','marketing',
        'raw_payload','consented_at',
    ];

    protected $casts = [
        'functional'   => 'boolean',
        'analytics'    => 'boolean',
        'marketing'    => 'boolean',
        'raw_payload'  => 'array',
        'consented_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
