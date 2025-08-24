<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    // Table : contact_messages (convention Eloquent) → pas besoin de $table
    // public $timestamps = true; // (implicite, donc inutile)

    protected $fillable = [
        'company_name',
        'name',
        'email',
        'subject',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
