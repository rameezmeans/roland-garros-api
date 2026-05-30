<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TennisMatch extends Model
{
    /** @use HasFactory<\Database\Factories\TennisMatchFactory> */
    use HasFactory;

    protected $fillable = [
        'tournament_name',
        'round',
        'player_one_id',
        'player_two_id',
        'winner_id',
        'score',
        'played_at',
    ];

    protected $casts = [
        'played_at' => 'datetime',
    ];

    public function playerOne()
    {
        return $this->belongsTo(Player::class, 'player_one_id');
    }

    public function playerTwo()
    {
        return $this->belongsTo(Player::class, 'player_two_id');
    }

    public function winner()
    {
        return $this->belongsTo(Player::class, 'winner_id');
    }
}
