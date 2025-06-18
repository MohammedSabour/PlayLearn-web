<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'id_jeu',
    ];
    
    public function jeu()
    {
        return $this->belongsTo(Jeu::class, 'id_jeu');
    }

}
