<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreTennisMatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tournament_name' => ['required', 'string', 'max:255'],
            'round' => ['required', 'string', 'max:255'],

            'player_one_id' => ['required', 'integer', 'exists:players,id'],
            'player_two_id' => ['required', 'integer', 'exists:players,id', 'different:player_one_id'],

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

                $players = [
                    (int) $this->input('player_one_id'),
                    (int) $this->input('player_two_id'),
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