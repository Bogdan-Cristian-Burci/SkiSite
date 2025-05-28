<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InstructorMiddleware
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

        if (!$user->hasAnyRole(['instructor', 'admin'])) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Access denied. Instructor or admin role required.'], 403);
            }
            abort(403, 'Access denied. Instructor or admin role required.');
        }

        return $next($request);
    }
}