<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request): JsonResponse
    {
        $player = Player::create(
            $request->validated()
        );

        return response()->json([
            'data' => new PlayerResource($player),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player): PlayerResource
    {
        return new PlayerResource($player);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdatePlayerRequest $request,
        Player $player
    ): PlayerResource {

        $player->update(
            $request->validated()
        );
        return new PlayerResource($player);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player): JsonResponse
    {
        $player->delete();
        return response()->json([
            'message' => 'Player deleted successfully',
        ]);
    }
}
