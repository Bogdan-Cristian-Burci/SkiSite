<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check authentication for both web sessions and API tokens
        $user = Auth::guard('web')->user() ?? Auth::guard('sanctum')->user();
        
        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('login');
        }

        if (!$user->hasRole('admin')) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Access denied. Admin role required.'], 403);
            }
            abort(403, 'Access denied. Admin role required.');
        }

        return $next($request);
    }
}