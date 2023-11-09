<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_address',
    ];

    public function names()
    {
        return $this->belongsTo(Name::class, 'name_id', 'id');
    }
}
