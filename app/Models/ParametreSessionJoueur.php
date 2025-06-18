<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParametreSessionJoueur extends Model
{
    protected $fillable = [
        'session_joueur_id',
        'id_parametre',
        'valeur',
    ];

    // Relation avec SessionJoueur
    public function sessionJoueur()
    {
        return $this->belongsTo(SessionJoueur::class);
    }

    // Relation avec Parametre
    public function parametre()
    {
        return $this->belongsTo(Parametre::class, 'id_parametre');
    }
}
