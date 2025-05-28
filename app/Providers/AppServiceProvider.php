<?php

namespace App\Providers;

use App\Models\HeaderImage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.header-inner', function ($view) {
            $currentRoute = request()->route()->getName();
            
            $headerImage = HeaderImage::where('route_name', $currentRoute)
                ->where('is_active', true)
                ->first();
            
            $imageUrl = $headerImage 
                ? asset('storage/' . $headerImage->image_path)
                : asset('images/bg-image-1.jpg');
            
            $view->with('headerImageUrl', $imageUrl);
        });

    }
}
