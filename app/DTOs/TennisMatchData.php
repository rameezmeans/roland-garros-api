<?php

namespace App\DTOs;

class TennisMatchData
{
    public function __construct(
        public readonly string $tournament_name,
        public readonly string $round,
        public readonly int $player1_id,
        public readonly int $player2_id,
        public readonly ?int $winner_id,
        public readonly ?string $score,
        public readonly ?string $played_at,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            tournament_name: $data['tournament_name'],
            round: $data['round'],
            player1_id: (int) $data['player1_id'],
            player2_id: (int) $data['player2_id'],
            winner_id: isset($data['winner_id']) ? (int) $data['winner_id'] : null,
            score: $data['score'] ?? null,
            played_at: $data['played_at'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'tournament_name' => $this->tournament_name,
            'round' => $this->round,
            'player1_id' => $this->player1_id,
            'player2_id' => $this->player2_id,
            'winner_id' => $this->winner_id,
            'score' => $this->score,
            'played_at' => $this->played_at,
        ];
    }
}