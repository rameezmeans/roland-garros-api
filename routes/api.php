<?php

use App\Http\Controllers\Api\V1\PlayerController;
use App\Http\Controllers\Api\V1\TennisMatchController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('players', PlayerController::class);

    Route::apiResource('matches', TennisMatchController::class)
        ->parameters([
            'matches' => 'match',
        ]);
});