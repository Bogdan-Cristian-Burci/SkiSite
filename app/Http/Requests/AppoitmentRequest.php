<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppoitmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'number_of_adults' => ['required', 'integer', 'min:0'],
            'number_of_children' => ['required', 'integer', 'min:0'],
            'hours_per_day' => ['required', 'integer', 'min:1', 'max:24'],
            'user_id' => ['required', 'exists:users,id'],
            'ski_instructor_id' => ['required', 'exists:ski_instructors,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
