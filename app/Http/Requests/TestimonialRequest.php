<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function rules()
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');
        
        return [
            'author_name' => ['required', 'string', 'max:255'],
            'author_image' => [$isUpdate ? 'nullable' : 'required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'content' => ['required', 'array'],
            'content.*' => ['required', 'string'],
            'social_link' => ['nullable', 'url', 'max:500'],
            'approved_status' => ['boolean'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
