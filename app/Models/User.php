<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    /**
     * Les attributs pouvant être remplis par assignation de masse.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_guest',
    ];

    /**
     * Les attributs cachés lors de la sérialisation.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Les attributs à ajouter dans l’array du modèle.
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Cast des attributs.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_guest' => 'boolean',
        ];
    }

    /**
     * Relation : Un utilisateur (Master) peut créer plusieurs quiz.
     */
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class, 'id_user');
    }

    /**
     * Relation : Un utilisateur (joueur ou invité) peut participer à plusieurs sessions.
     */
    public function sessions(): BelongsToMany
    {
        return $this->belongsToMany(GameSession::class, 'session_joueur')
                    ->withPivot('player_name','is_guest', 'joined_at')
                    ->withTimestamps();
    }

    /**
     * Relation : Un utilisateur soumet plusieurs réponses.
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class, 'id_user');
    }

    /**
     * Relation : Un utilisateur peut avoir plusieurs scores.
     */
    public function scores(): HasMany
    {
        return $this->hasMany(Score::class, 'id_user');
    }

    /**
     * Définir une règle pour éviter qu'un invité ait un email ou un mot de passe.
     */
    public function setIsGuestAttribute($value)
    {
        $this->attributes['is_guest'] = $value;

        if ($value) {
            $this->attributes['email'] = null;
            $this->attributes['password'] = null;
        }
    }
}
