<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ChoixReponse extends Model
{
    protected $fillable = [
        'choice_text',
        'is_correct',
        'variation',
        'id_question',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'id_question');
    }
    
}
