<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChoixDecision extends Model
{
    protected $fillable = [
        'choice_text',
        'id_decision',
    ];

    public function levels(): HasMany
    {
        return $this->hasMany(DecisionLevel::class, 'id_choix_decision');
    }

    public function decision(): BelongsTo
    {
        return $this->belongsTo(Decision::class, 'id_decision');
    }
}
