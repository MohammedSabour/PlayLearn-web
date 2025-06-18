<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'choix_reponse_id',
        'is_correct',
        'id_session_joueur',
        'submitted_at',
    ];

    public function sessionjoueur(): BelongsTo
    {
        return $this->belongsTo(SessionJoueur::class);
    }

    public function joueur(): BelongsTo
    {
        return $this->sessionJoueur->player();
    }
    
    public function choixReponse(): BelongsTo
    {
        return $this->belongsTo(ChoixReponse::class, 'choix_reponse_id');
        
    }

    public function Effet(): HasMany
    {
        return $this->hasMany(Effet::class);
    }
}
