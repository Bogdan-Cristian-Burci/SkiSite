<?php

if (!function_exists('localized_route')) {
    /**
     * Generate a localized route URL
     *
     * @param string $name
     * @param array $parameters
     * @param string|null $locale
     * @return string
     */
    function localized_route($name, $parameters = [], $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        
        // Create the localized route name
        $localizedRouteName = $locale . '.' . $name;
        
        // Check if localized route exists, otherwise use fallback
        if (\Illuminate\Support\Facades\Route::has($localizedRouteName)) {
            return route($localizedRouteName, $parameters);
        } elseif (\Illuminate\Support\Facades\Route::has($name . '.fallback')) {
            return route($name . '.fallback', $parameters);
        } else {
            return route($name, $parameters);
        }
    }
}