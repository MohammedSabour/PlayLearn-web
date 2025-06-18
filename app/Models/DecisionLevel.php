<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class DecisionLevel extends Model
{
    protected $table = 'decisions_levels';
    protected $fillable = [
        'level',
        'description',
        'cout',
        'id_choix_decision',
    ];

    public function choixDecision(): BelongsTo
    {
        return $this->belongsTo(ChoixDecision::class, 'id_choix_decision');
    }

    public function effets(): HasMany
    {
        return $this->hasMany(ParametreImpact::class, 'id_level_choix');
    }
}
