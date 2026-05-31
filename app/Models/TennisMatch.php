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
        'player1_id',
        'player2_id',
        'winner_id',
        'score',
        'played_at',
    ];

    protected $casts = [
        'played_at' => 'datetime',
    ];

    public function playerOne()
    {
        return $this->belongsTo(Player::class, 'player1_id');
    }

    public function playerTwo()
    {
        return $this->belongsTo(Player::class, 'player2_id');
    }

    public function winner()
    {
        return $this->belongsTo(Player::class, 'winner_id');
    }
}
