<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\PlayerData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use App\Services\PlayerService;
use Illuminate\Http\JsonResponse;

class PlayerController extends Controller
{
    public function __construct(
        private readonly PlayerService $playerService
    ) {
    }

    public function index()
    {
        $players = Player::query()
            ->when(
                request('country'),
                fn ($query, $country) => $query->where('country', $country)
            )
            ->when(
                request()->filled('active'),
                fn ($query) => $query->where('active', request('active'))
            )
            ->orderBy(
                request('sort', 'ranking')
            )
            ->paginate(10);

        return PlayerResource::collection($players);
    }

    public function store(StorePlayerRequest $request): JsonResponse
    {
        $player = $this->playerService->create(
            PlayerData::fromArray($request->validated())
        );

        return response()->json([
            'data' => new PlayerResource($player),
        ], 201);
    }

    public function show(Player $player): PlayerResource
    {
        return new PlayerResource($player);
    }

    public function update(
        UpdatePlayerRequest $request,
        Player $player
    ): PlayerResource {
        $player = $this->playerService->update(
            $player,
            PlayerData::fromArray(
                array_merge(
                    $player->toArray(),
                    $request->validated()
                )
            )
        );

        return new PlayerResource($player);
    }

    public function destroy(Player $player): JsonResponse
    {
        $player->delete();

        return response()->json([
            'message' => 'Player deleted successfully',
        ]);
    }
}