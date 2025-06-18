<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Effet extends Model
{
    protected $fillable = [
        'variation',
        'session_joueur_id',
        'id_submission',
        'id_parametre',
    ];

    public function soumission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    public function parametre(): BelongsTo
    {
        return $this->belongsTo(Parametre::class);
    }

    public function sessionJoueur()
    {
        return $this->belongsTo(SessionJoueur::class);
    }
}
