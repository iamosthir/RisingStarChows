<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'competition_wins',
        'best_in_shows',
        'champions',
        'international_shows',
    ];

    protected $casts = [
        'competition_wins' => 'integer',
        'best_in_shows' => 'integer',
        'champions' => 'integer',
        'international_shows' => 'integer',
    ];
}
