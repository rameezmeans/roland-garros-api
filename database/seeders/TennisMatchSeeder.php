<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\TennisMatch;
use Illuminate\Database\Seeder;

class TennisMatchSeeder extends Seeder
{
    public function run(): void
    {
        $sabalenka = Player::where('name', 'Aryna Sabalenka')->first();
        $gauff = Player::where('name', 'Coco Gauff')->first();

        TennisMatch::create([
            'tournament_name' => 'Roland Garros',
            'round' => 'Quarterfinal',
            'player1_id' => $sabalenka->id,
            'player2_id' => $gauff->id,
            'winner_id' => $sabalenka->id,
            'score' => '6-4 7-5',
            'played_at' => now(),
        ]);
    }
}