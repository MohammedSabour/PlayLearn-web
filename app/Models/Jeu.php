<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use staabm\SideEffectsDetector\SideEffect;

class Jeu extends Model
{
    use HasFactory;
    protected $table = 'jeux';
    protected $fillable = [
        'titre',
        'description',
    ];
    
    public function parametres(): HasMany
    {
        return $this->hasMany(Parametre::class, 'id_jeu');
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class, 'id_jeu');
    }

    public function decision()
    {
        return $this->hasOne(Decision::class, 'id_jeu');
    }

    public function simulation()
    {
        return $this->hasOne(Simulation::class, 'id_jeu');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(GameSession::class);
    }
    
}
