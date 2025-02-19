<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_quiz',
        'question_text',
        'points',
        'time',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'id_quiz');
    }

    public function choices(): HasMany
    {
        return $this->hasMany(Choice::class, 'id_question');
    }
}
