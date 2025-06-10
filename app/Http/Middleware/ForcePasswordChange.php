<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->must_change_password) {
            // Allow access to password change routes, logout, and asset requests
            $allowedRoutes = [
                'password.change',
                'password.change.update',
                'logout'
            ];
            
            // Allow asset requests (CSS, JS, images)
            if ($request->is('css/*') || $request->is('js/*') || $request->is('images/*') || $request->is('fonts/*') || $request->is('storage/*')) {
                return $next($request);
            }
            
            if (!$request->routeIs($allowedRoutes)) {
                return redirect()->route('password.change')
                    ->with('warning', 'You must change your password before continuing.');
            }
        }
        
        return $next($request);
    }
}
