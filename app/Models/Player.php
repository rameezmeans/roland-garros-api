<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /** @use HasFactory<\Database\Factories\PlayerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'ranking',
        'seed',
        'age',
        'handedness',
        'img_url',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    // public function hasMatchesAsPlayer1()
    // {
    //     return $this->hasMany(TennisMatch::class, 'player1_id');
    // }

    // public function hasMatchesAsPlayer2()
    // {
    //     return $this->hasMany(TennisMatch::class, 'player2_id');
    // }
    
    public function matches()
    {
        return $this->hasMany(TennisMatch::class, 'player1_id')
                    ->orWhere('player2_id', $this->id);
    }

    public function wins()
    {
        return $this->hasMany(TennisMatch::class, 'winner_id');
    }
    
}
