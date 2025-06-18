<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecisionJoueur extends Model
{
    use HasFactory;
    protected $table = 'decisions_joueur';
    protected $fillable = [
        'id_session_joueur',
        'id_choix_decision',
        'id_level_choix',
        'submitted_at',
    ];

    public function sessionJoueur()
    {
        return $this->belongsTo(SessionJoueur::class, 'id_session_joueur');
    }

    public function choixDecision()
    {
        return $this->belongsTo(ChoixDecision::class, 'id_choix_decision');
    }

    public function levelChoix()
    {
        return $this->belongsTo(DecisionLevel::class, 'id_level_choix');
    }
}
