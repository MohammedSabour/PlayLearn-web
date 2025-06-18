<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParametreImpact extends Model
{
    protected $fillable = [
        'id_level_choix',
        'id_parametre',
        'valeur_impact',
    ];

    public function levelChoix()
    {
        return $this->belongsTo(DecisionLevel::class, 'id_level_choix');
    }

    public function parametre(): BelongsTo
    {
        return $this->belongsTo(Parametre::class, 'id_parametre');
    }
}
