<?php

use App\Http\Controllers\Api\V1\PlayerController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->group(function () {
        Route::apiResource(
            'players',
            PlayerController::class
        );
    });