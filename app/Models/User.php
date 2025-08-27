<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['company_name','name','email','phone','password', 

        // Consentement cookies
        'cookie_consent_status',
        'cookie_consent_at',
        'cookie_consent_ip',
        'cookie_consent_user_agent',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'cookie_consent_at' => 'datetime',
        ];
    }
    public function cvDownloads()
{
    return $this->hasMany(CvDownload::class);
}

public function lastCvDownload()
{
    return $this->hasOne(CvDownload::class)->latestOfMany();
}

    
}
