<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordChangeController extends Controller
{
    public function show()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($request->password),
            'must_change_password' => false,
        ]);

        // Redirect based on user role
        if ($user->hasAnyRole(['admin', 'instructor'])) {
            $redirect = '/admin';
        } else {
            $redirect = '/';
        }
        
        return redirect()->intended($redirect)
            ->with('success', 'Password changed successfully!');
    }
}
