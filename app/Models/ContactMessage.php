<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',       // Expéditeur
        'recipient_id',  // Destinataire
        'company_name',
        'name',
        'email',
        'subject',
        'message',
        'is_read',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Expéditeur (user qui envoie le message)
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Destinataire (user qui reçoit le message)
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
