<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['company_name','name','email','subject','message','is_read'];
    protected $casts   = ['is_read'=>'boolean'];
}
