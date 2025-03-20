<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    use HasFactory;
    protected $table = 'game_sessions';
    protected $fillable = [
        'id_quiz',
        'id_user',
        'code_adhesion',
        'status',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'id_quiz');
    }

    public function master(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'session_joueur', 'id_session', 'id_user')
                    ->withPivot('player_name','is_guest', 'joined_at')
                    ->withTimestamps();
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class, 'id_session');
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class, 'id_session');
    }

    public function endSession()
    {
        $this->update(['status' => 'finished']);
    }
}
