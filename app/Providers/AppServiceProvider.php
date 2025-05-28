<?php

namespace App\Providers;

use App\Models\HeaderImage;
use App\Models\Regulation;
use App\Models\SkiProgram;
use App\Models\Company;
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



            $view->with([
                'headerImageUrl'=> $imageUrl,
            ]);
        });

        View::composer('partials.footer', function ($view) {
            $skiPrograms = SkiProgram::take(4)->get();

            $company = Company::first();
            $regulations = Regulation::all();

            $view->with([
                'footerSkiPrograms' => $skiPrograms,
                'footerCompany' => $company,
                'footerRegulations' => $regulations,
            ]);
        });

        View::composer('partials.navbar-inner', function ($view) {
            $skiPrograms = SkiProgram::all();

            $view->with([
                'skiPrograms' => $skiPrograms
            ]);
        });

        View::composer('partials.header-home', function ($view) {

            $skiPrograms = SkiProgram::all();
            $company = Company::first();

            $view->with([
                'skiPrograms' => $skiPrograms,
                'company' => $company
            ]);

        });

    }
}
