<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampRequest extends FormRequest
{
    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'title' => ['required', 'array'],
            'title.*' => ['required', 'string', 'max:255'],
            'article_content' => ['required', 'array'],
            'article_content.*' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'age_condition' => ['required', 'array'],
            'age_condition.*' => ['required', 'string'],
            'location' => ['required', 'array'],
            'location.*' => ['required', 'string'],
            'image_path' => [$isUpdate ? 'nullable' : 'required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'price_info' => ['required', 'array'],
            'price_info.*' => ['required', 'string'],
            'transport_info' => ['required', 'array'],
            'transport_info.*' => ['required', 'string'],
            'meal_info' => ['required', 'array'],
            'meal_info.*' => ['required', 'string'],
            'accommodation_info' => ['required', 'array'],
            'accommodation_info.*' => ['required', 'string'],
            'capacity' => ['required', 'integer', 'min:0'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
