<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\TennisMatchData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTennisMatchRequest;
use App\Http\Requests\UpdateTennisMatchRequest;
use App\Http\Resources\TennisMatchResource;
use App\Models\TennisMatch;
use App\Services\TennisMatchService;
use Illuminate\Http\JsonResponse;

class TennisMatchController extends Controller
{
    public function __construct(
        private readonly TennisMatchService $tennisMatchService
    ) {
    }

    public function index()
    {
        $matches = TennisMatch::query()
            ->with([
                'playerOne',
                'playerTwo',
                'winner',
            ])
            ->when(
                request('round'),
                fn ($query, $round) => $query->where('round', $round)
            )
            ->when(
                request('tournament_name'),
                fn ($query, $tournamentName) => $query->where('tournament_name', $tournamentName)
            )
            ->latest()
            ->paginate(10);

        return TennisMatchResource::collection($matches);
    }

    public function store(StoreTennisMatchRequest $request): JsonResponse
    {
        $match = $this->tennisMatchService->create(
            TennisMatchData::fromArray($request->validated())
        );

        return response()->json([
            'data' => new TennisMatchResource(
                $match->load([
                    'playerOne',
                    'playerTwo',
                    'winner',
                ])
            ),
        ], 201);
    }

    public function show(TennisMatch $match): TennisMatchResource
    {
        return new TennisMatchResource(
            $match->load([
                'playerOne',
                'playerTwo',
                'winner',
            ])
        );
    }

    public function update(
        UpdateTennisMatchRequest $request,
        TennisMatch $match
    ): TennisMatchResource {
        $match = $this->tennisMatchService->update(
            $match,
            TennisMatchData::fromArray(
                array_merge(
                    $match->toArray(),
                    $request->validated()
                )
            )
        );

        return new TennisMatchResource(
            $match->load([
                'playerOne',
                'playerTwo',
                'winner',
            ])
        );
    }

    public function destroy(TennisMatch $match): JsonResponse
    {
        $match->delete();

        return response()->json([
            'message' => 'Match deleted successfully',
        ]);
    }
}