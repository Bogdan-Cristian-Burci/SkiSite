<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeroSliderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'title.*' => ['string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'subtitle.*' => ['string', 'max:255'],
            'background_text' => ['nullable', 'string', 'max:255'],
            'background_text.*' => ['string', 'max:255'],
            'image_path' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.*.string' => 'Each title translation must be a string.',
            'title.*.max' => 'Each title translation may not be greater than 255 characters.',
            'subtitle.string' => 'The subtitle must be a string.',
            'subtitle.max' => 'The subtitle may not be greater than 255 characters.',
            'subtitle.*.string' => 'Each subtitle translation must be a string.',
            'subtitle.*.max' => 'Each subtitle translation may not be greater than 255 characters.',
            'image_path.required' => 'The image path field is required.',
            'image_path.string' => 'The image path must be a string.',
        ];
    }
}
