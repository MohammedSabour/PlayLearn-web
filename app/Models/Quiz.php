<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $table = 'quizz';
    protected $fillable = [
        'titre',
        'description',
        'id_jeu',
        'id_parametre',
    ];

    public function jeu()
    {
        return $this->belongsTo(Jeu::class, 'id_jeu');
    }

    public function parametre() 
    {
        return $this->belongsTo(Parametre::class, 'id_parametre');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'id_quiz');
    } 
}
