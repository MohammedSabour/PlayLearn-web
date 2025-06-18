<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    use HasFactory;
    protected $table = 'game_sessions';
    protected $fillable = [
        'id_jeu',
        'id_master',
        'code_adhesion',
        'status',
        'mode',
        'nb_rounds',
    ];

    public function jeu(): BelongsTo
    {
        return $this->belongsTo(Jeu::class, 'id_jeu');
    }

    public function master(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'session_joueur', 'id_session', 'id_player')
                    ->withPivot('player_name','is_guest', 'joined_at');
    }

    public function endSession()
    {
        $this->update(['status' => 'finished']);
    }
}
