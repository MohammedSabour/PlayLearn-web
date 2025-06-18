<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\NatureParametre;

class Parametre extends Model
{
    protected $fillable = [
        'nom',
        'valeur_initiale',
        'unite',
        'id_jeu',
    ];

    
    public function jeu(): BelongsTo
    {
        return $this->belongsTo(Jeu::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'id_parametre');
    }

    public function effets() 
    {
        return $this->hasMany(Effet::class);
    }
    
}
