<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jeu extends Model
{
    protected $fillable = [
        'id_session',
        'id_user',
        'titre',
        'description',
    ];
    
}
