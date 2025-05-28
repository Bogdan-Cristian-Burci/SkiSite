<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebcamRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'array'],
            'title.*' => ['required', 'string', 'max:255'],
            'iframe_link' => ['required', 'url', 'max:1000'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
