<?php

namespace App\DTOs;

class PlayerData
{
    public function __construct(
        public readonly string $name,
        public readonly string $country,
        public readonly int $ranking,
        public readonly ?int $seed,
        public readonly int $age,
        public readonly string $handedness,
        public readonly ?string $img_url,
        public readonly bool $active,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            country: $data['country'],
            ranking: (int) $data['ranking'],
            seed: isset($data['seed']) ? (int) $data['seed'] : null,
            age: (int) $data['age'],
            handedness: $data['handedness'],
            img_url: $data['img_url'] ?? null,
            active: $data['active'] ?? true,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'country' => $this->country,
            'ranking' => $this->ranking,
            'seed' => $this->seed,
            'age' => $this->age,
            'handedness' => $this->handedness,
            'img_url' => $this->img_url,
            'active' => $this->active,
        ];
    }
}