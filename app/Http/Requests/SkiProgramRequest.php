<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkiProgramRequest extends FormRequest
{
    public function rules()
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'title' => ['required', 'array'],
            'title.*' => ['required', 'string', 'max:255'],
            'description' => ['required', 'array'],
            'description.*' => ['required', 'string'],
            'price_label' => ['required', 'array'],
            'price_label.*' => ['required', 'string', 'max:100'],
            'details' => ['nullable', 'array'],
            'details.*' => ['nullable', 'array'],
            'included_services' => ['nullable', 'array'],
            'included_services.*' => ['nullable', 'array'],
            'how_we_work' => ['nullable', 'array'],
            'how_we_work.*' => ['nullable', 'string'],
            'slug' => ['required', 'array'],
            'slug.*' => ['required', 'string', 'max:255'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'image' => [$isUpdate ? 'nullable' : 'required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
