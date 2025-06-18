<?php

namespace App\Models;

use App\View\Pages\Game;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SessionJoueur extends Pivot
{
    use HasFactory;

    protected $table = 'session_joueur';
    protected $fillable = [
        'id_session',
        'id_player',
        'player_name',
        'is_guest',
        'joined_at'
    ];
    public $timestamps = true;
    protected $dates = ['joined_at'];

    public function session(): BelongsTo
    {
        return $this->belongsTo(GameSession::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_player');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class, 'id_session_joueur');
    }

    public function effet()
    {
        return $this->hasMany(Effet::class, 'id_session_joueur');
    }

    public function parametres()
    {
        return $this->belongsToMany(Parametre::class, 'parametre_session_joueurs', 'session_joueur_id', 'id_parametre')
                    ->withPivot('valeur');
    }

    public function getCash($cashParametreId)
    {
        return $this->parametres
            ->firstWhere('id', $cashParametreId)
            ?->pivot
            ?->valeur ?? 0;
    }
}
