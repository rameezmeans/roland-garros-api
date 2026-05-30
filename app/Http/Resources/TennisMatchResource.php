<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TennisMatchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'tournament_name' => $this->tournament_name,
            'round' => $this->round,

            'player_one' => new PlayerResource($this->whenLoaded('playerOne')),
            'player_two' => new PlayerResource($this->whenLoaded('playerTwo')),
            'winner' => new PlayerResource($this->whenLoaded('winner')),

            'score' => $this->score,

            'played_at' => $this->played_at?->toISOString(),

            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}