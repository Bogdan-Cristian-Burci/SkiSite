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
            'content' => ['required', 'array'],
            'content.*' => ['required', 'string'],
            'approved_status' => ['boolean'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
