<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SessionJoueur extends Pivot
{
    use HasFactory;

    protected $table = 'session_joueur';
    protected $fillable = [
        'id_session',
        'id_user',
        'player_name',
        'is_guest',
        'joined_at'
    ];
    public $timestamps = true;
    protected $dates = ['joined_at'];
}
