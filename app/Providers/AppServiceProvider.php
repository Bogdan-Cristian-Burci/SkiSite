<?php

namespace App\Providers;

use App\Models\HeaderImage;
use App\Models\Regulation;
use App\Models\SkiInstructor;
use App\Models\SkiProgram;
use App\Models\Company;
use App\Models\WhyChooseUs;
use Illuminate\Support\Facades\Storage;
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
                ? Storage::disk('public')->url($headerImage->image_path)
                : asset('images/bg-image-1.jpg');


            $company = Company::first();
            $view->with([
                'headerImageUrl'=> $imageUrl,
                'company' => $company
            ]);
        });

        View::composer('partials.footer', function ($view) {
            $skiPrograms = SkiProgram::take(4)->get();

            $regulations = Regulation::all();
            $company = Company::first();

            $view->with([
                'footerSkiPrograms' => $skiPrograms,
                'company' => $company,
                'footerRegulations' => $regulations,
            ]);
        });

        View::composer('partials.navbar-inner', function ($view) {
            $skiPrograms = SkiProgram::all();

            $view->with([
                'skiPrograms' => $skiPrograms,
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
