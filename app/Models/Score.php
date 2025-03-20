<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_session',
        'score',
        'completed_at',
    ];

    protected $casts = [
        'score' => 'integer',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(GameSession::class, 'id_session');
    }
}
