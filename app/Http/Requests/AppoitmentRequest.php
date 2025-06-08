<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppoitmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => [
                'required', 
                'date', 
                'after:today',
                'before:' . now()->addDays(config('appointment.validation.max_date', 365))->format('Y-m-d')
            ],
            'end_date' => [
                'required', 
                'date', 
                'after_or_equal:start_date',
                'before:' . now()->addDays(config('appointment.validation.max_date', 365))->format('Y-m-d')
            ],
            'number_of_adults' => [
                'required', 
                'integer', 
                'min:0', 
                'max:' . config('appointment.limits.max_adults', 10)
            ],
            'number_of_children' => [
                'required', 
                'integer', 
                'min:0', 
                'max:' . config('appointment.limits.max_children', 8)
            ],
            'hours_per_day' => [
                'required', 
                'integer', 
                'min:1', 
                'max:' . config('appointment.limits.max_hours_per_day', 8)
            ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $adults = $this->input('number_of_adults', 0);
            $children = $this->input('number_of_children', 0);
            
            if ($adults == 0 && $children == 0) {
                $validator->errors()->add('number_of_adults', 'At least one adult or child is required.');
            }
        });
    }

    public function authorize(): bool
    {
        return true;
    }
}
