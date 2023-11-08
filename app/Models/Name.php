<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    use HasFactory;

    protected $fillable = [
        'nev',
        'address',
        'email_address',
        'photo',
    ];

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}
