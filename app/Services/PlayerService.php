<?php

namespace App\Services;

use App\DTOs\PlayerData;
use App\Models\Player;

class PlayerService
{
    public function create(PlayerData $data): Player
    {
        return Player::create(
            $data->toArray()
        );
    }

    public function update(Player $player, PlayerData $data): Player
    {
        $player->update(
            $data->toArray()
        );

        return $player->fresh();
    }
}