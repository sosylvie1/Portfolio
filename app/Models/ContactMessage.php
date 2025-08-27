<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 👈 ajoute ça

class ContactMessage extends Model
{
    use HasFactory, SoftDeletes; // 👈 active les soft deletes

    protected $fillable = [
        'user_id',
        'company_name',
        'name',
        'email',
        'subject',
        'message',
        'is_read',
        'status',   // ✅ on autorise le statut
    ];

    protected $dates = ['deleted_at']; // 👈 pour gérer la date de suppression
    // Relation avec l’utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
