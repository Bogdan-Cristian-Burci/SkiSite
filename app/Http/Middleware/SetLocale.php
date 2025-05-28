<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Get the first URL segment
            $firstSegment = $request->segment(1);
            
            // Determine locale based on URL structure
            if ($firstSegment === 'en') {
                // English routes have 'en' prefix
                $locale = 'en';
            } else {
                // Romanian routes have no prefix (default language)
                $locale = 'ro';
            }
            
            // Set the locale using Laravel's method (NOT PHP's setlocale)
            App::setLocale($locale);
            Session::put('locale', $locale);
            
        } catch (\Exception $e) {
            // If something goes wrong, default to Romanian
            App::setLocale('ro');
            Session::put('locale', 'ro');
        }
        
        return $next($request);
    }
}