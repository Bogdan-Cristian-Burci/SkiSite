<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactReceived;
use App\Mail\ContactNotification;
use App\Models\Contact;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            
            // Sanitize input data
            $sanitizedData = [
                'name' => strip_tags(trim($validatedData['name'])),
                'email' => filter_var(trim($validatedData['email']), FILTER_SANITIZE_EMAIL),
                'subject' => strip_tags(trim($validatedData['subject'])),
                'message' => strip_tags(trim($validatedData['message'])),
            ];
            
            $contact = Contact::create($sanitizedData);

            Mail::to($contact->email)->send(new ContactReceived($contact));

            $adminUsers = User::role('admin')->get();
            foreach ($adminUsers as $admin) {
                Mail::to($admin->email)->send(new ContactNotification($contact));
            }

            return response()->json([
                'success' => true,
                'message' => __('Thank you for contacting us! We will get back to you soon.'),
            ]);

        } catch (\Exception $e) {
            \Log::error('Contact form submission failed: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->validated()
            ]);

            return response()->json([
                'success' => false,
                'message' => __('Something went wrong. Please try again.'),
            ], 500);
        }
    }

    public function webIndex()
    {
        $company = \Cache::remember('contact_company_data', 3600, function () {
            return Company::first();
        });

        return view('contact', compact('company'));
    }
}
