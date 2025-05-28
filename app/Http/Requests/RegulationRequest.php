<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegulationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'array'],
            'title.*' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'array'],
            'subtitle.*' => ['required', 'string', 'max:500'],
            'content' => ['required', 'array'],
            'content.*' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
