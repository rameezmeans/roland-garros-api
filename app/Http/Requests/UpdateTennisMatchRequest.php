<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateTennisMatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tournament_name' => ['sometimes', 'required', 'string', 'max:255'],
            'round' => ['sometimes', 'required', 'string', 'max:255'],

            'player_one_id' => ['sometimes', 'required', 'integer', 'exists:players,id'],
            'player_two_id' => ['sometimes', 'required', 'integer', 'exists:players,id', 'different:player_one_id'],

            'winner_id' => ['nullable', 'integer', 'exists:players,id'],

            'score' => ['nullable', 'string', 'max:255'],
            'played_at' => ['nullable', 'date'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $winnerId = $this->input('winner_id');

                if (! $winnerId) {
                    return;
                }

                $playerOneId = $this->input(
                    'player_one_id',
                    $this->route('match')?->player_one_id
                );

                $playerTwoId = $this->input(
                    'player_two_id',
                    $this->route('match')?->player_two_id
                );

                $players = [
                    (int) $playerOneId,
                    (int) $playerTwoId,
                ];

                if (! in_array((int) $winnerId, $players, true)) {
                    $validator->errors()->add(
                        'winner_id',
                        'Winner must be either player one or player two.'
                    );
                }
            }
        ];
    }
}