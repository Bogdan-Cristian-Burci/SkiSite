<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkiInstructorRequest extends FormRequest
{
    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');
        
        return [
            'position' => ['required', 'array'],
            'position.en' => ['required', 'string', 'max:255'],
            'position.ro' => ['required', 'string', 'max:255'],
            'bio' => ['required', 'array'],
            'bio.en' => ['required', 'string'],
            'bio.ro' => ['required', 'string'],
            'image' => [$isUpdate ? 'nullable' : 'required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'user_id' => ['nullable', 'exists:users,id'],
            'instructor_name' => ['nullable', 'string', 'max:255'],
            'instructor_email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'instructor_phone' => ['nullable', 'string', 'max:20'],
            'user.phone' => ['nullable', 'string', 'max:20'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
