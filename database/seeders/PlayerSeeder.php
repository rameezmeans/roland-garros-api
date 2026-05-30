<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        $players = [
            [
                'name' => 'Aryna Sabalenka',
                'country' => 'NEU',
                'ranking' => 1,
                'seed' => 1,
                'age' => 28,
                'handedness' => 'right',
            ],
            [
                'name' => 'Elena Rybakina',
                'country' => 'KAZ',
                'ranking' => 2,
                'seed' => 2,
                'age' => 23,
                'handedness' => 'right',
            ],
            [
                'name' => 'Coco Gauff',
                'country' => 'USA',
                'ranking' => 3,
                'seed' => 3,
                'age' => 23,
                'handedness' => 'right',
            ],
            [
                'name' => 'Iga Swiatek',
                'country' => 'POL',
                'ranking' => 4,
                'seed' => 4,
                'age' => 24,
                'handedness' => 'right',
            ],
            [
                'name' => 'Jessica Pegula',
                'country' => 'USA',
                'ranking' => 5,
                'seed' => 5,
                'age' => 27,
                'handedness' => 'right',
            ],
            [
                'name' => 'Amanda Amisimova',
                'country' => 'USA',
                'ranking' => 6,
                'seed' => 6,
                'age' => 24,
                'handedness' => 'right',
            ],
            [
                'name' => 'Elena Svitolina',
                'country' => 'UKR',
                'ranking' => 7,
                'seed' => 7,
                'age' => 31,
                'handedness' => 'right',
            ],
            [
                'name' => 'Mirra Andreeva',
                'country' => 'NEU',
                'ranking' => 8,
                'seed' => 8,
                'age' => 19,
                'handedness' => 'right',
            ],
            
        ];

        foreach ($players as $player) {
            Player::create(
                array_merge($player, [
                    'active' => true,
                ])
            );
        }
    }
}