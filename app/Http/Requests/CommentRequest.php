<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:1000'],
            'user_id' => ['sometimes', 'exists:users'],
            'blog_post_id' => ['sometimes', 'exists:blog_posts'],
            'aproved_status' => ['sometimes', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
