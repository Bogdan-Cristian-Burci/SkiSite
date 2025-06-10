<?php

namespace App\Http\Requests;

use App\Rules\RecaptchaV3;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\.\-]+$/'],
            'email' => ['required', 'email', 'max:255', 'filter:email'],
            'subject' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s\.\-\!\?]+$/'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'g-recaptcha-response' => ['required', new RecaptchaV3],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => __('Please enter your name.'),
            'email.required' => __('Please enter your email address.'),
            'email.email' => __('Please enter a valid email address.'),
            'subject.required' => __('Please enter a subject.'),
            'message.required' => __('Please enter your message.'),
            'message.min' => __('Your message must be at least 10 characters long.'),
            'message.max' => __('Your message cannot exceed 5000 characters.'),
            'g-recaptcha-response.required' => __('Please complete the captcha verification.'),
            'g-recaptcha-response.captcha' => __('Captcha verification failed. Please try again.'),
            'name.regex' => __('Name can only contain letters, spaces, periods, and hyphens.'),
            'subject.regex' => __('Subject contains invalid characters.'),
        ];
    }
}
