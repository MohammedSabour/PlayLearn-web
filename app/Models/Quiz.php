<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'id_user'
    ];

    public function master(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'id_quiz');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class, 'id_quiz');
    }
}
