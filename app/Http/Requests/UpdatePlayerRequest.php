<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'country' => ['sometimes', 'required', 'string', 'size:3'],
            'ranking' => ['sometimes', 'required', 'integer', 'min:1'],
            'seed' => ['nullable', 'integer', 'min:1'],
            'age' => ['sometimes', 'required', 'integer', 'min:14', 'max:60'],
            'handedness' => ['sometimes', 'required', 'in:left,right'],
            'img_url' => ['nullable', 'url'],
            'active' => ['sometimes', 'boolean'],
        ];
    }
}