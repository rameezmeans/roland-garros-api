<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePlayerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'size:3'],
            'ranking' => ['required', 'integer', 'min:1'],
            'seed' => ['nullable', 'integer', 'min:1'],
            'age' => ['required', 'integer', 'min:14', 'max:60'],
            'handedness' => ['required', 'in:left,right'],
            'image_url' => ['nullable', 'url'],
            'active' => ['boolean'],
        ];
    }
}
