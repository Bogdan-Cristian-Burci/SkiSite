<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{
    public function rules()
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');
        
        return [
            'title' => ['required', 'array'],
            'title.*' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'array'],
            'subtitle.*' => ['required', 'string', 'max:500'],
            'content' => ['required', 'array'],
            'content.*' => ['required', 'string'],
            'image' => [$isUpdate ? 'nullable' : 'required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'categories_id' => ['required', 'exists:categories,id'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
