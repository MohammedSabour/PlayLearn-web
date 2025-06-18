<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Decision extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'duration',
        'id_jeu',
    ];

    public function jeu()
    {
        return $this->belongsTo(Jeu::class, 'id_jeu');
    }
    
    public function choixDecisions(): HasMany
    {
        return $this->hasMany(ChoixDecision::class, 'id_decision');
    }
}
