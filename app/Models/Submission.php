<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_session',
        'id_user',
        'id_question',
        'id_selected_choice',
        'is_correct',
        'submitted_at',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class, 'id_session');
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'id_question');
    }

    public function choice(): BelongsTo
    {
        return $this->belongsTo(Choice::class, 'id_selected_choice');
    }
}
