<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'id_jeu',
    ];

    public function jeu() {
        return $this->belongsTo(Jeu::class);
    }
}
