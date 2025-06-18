<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\QuestionType;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_quiz',
        'type',
        'question_text',
        'time',
    ];

    protected $casts = [
        'type' => QuestionType::class,
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function choices(): HasMany
    {
        return $this->hasMany(ChoixReponse::class, 'id_question');
    }
}
