<?php

namespace App\Services;

use App\DTOs\TennisMatchData;
use App\Models\TennisMatch;

class TennisMatchService
{
    public function create(TennisMatchData $data): TennisMatch
    {
        return TennisMatch::create(
            $data->toArray()
        );
    }

    public function update(TennisMatch $match, TennisMatchData $data): TennisMatch
    {
        $match->update(
            $data->toArray()
        );

        return $match->fresh();
    }
}