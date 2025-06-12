<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Camp;
use App\Models\Company;
use App\Models\DividingSection;
use App\Models\HeroSlider;
use App\Models\PopularDestination;
use App\Models\SkiInstructor;
use App\Models\SkiProgram;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->get('locale', app()->getLocale());

        // Cache homepage data for 30 minutes, separate by locale
        $cacheKey = "homepage_data_{$locale}";
        
        $data = \Cache::remember($cacheKey, 1800, function () use ($locale) {
            return [
                'heroSliders' => HeroSlider::all(),
                'skiPrograms' => SkiProgram::all(),
                'skiInstructors' => SkiInstructor::take(2)->get(),
                'camps' => Camp::take(3)->get(),
                'blogs' => BlogPost::with(['categories'])->orderBy('created_at', 'desc')->take(2)->get(),
                'testimonials' => Testimonial::where('approved_status', true)->take(10)->get(),
                'popularDestinations' => PopularDestination::active()->ordered()->get(),
                'whyChooseUs' => WhyChooseUs::active()->ordered()->take(3)->get(),
                'dividingSection' => DividingSection::active()->first(),
                'company' => Company::first(),
            ];
        });

        // Set locale for translatable models
        $data['heroSliders']->each(function ($heroSlider) use ($locale) {
            $heroSlider->setLocale($locale);
        });

        $data['testimonials']->each(function ($testimonial) use ($locale) {
            $testimonial->setLocale($locale);
        });

        $data['skiPrograms']->each(function ($skiProgram) use ($locale) {
            $skiProgram->setLocale($locale);
        });

        return view('index', [
            'heroSliders' => $data['heroSliders'],
            'skiPrograms' => $data['skiPrograms'], 
            'skiInstructors' => $data['skiInstructors'],
            'camps' => $data['camps'],
            'blogs' => $data['blogs'],
            'testimonials' => $data['testimonials'],
            'popularDestinations' => $data['popularDestinations'],
            'whyChooseUs' => $data['whyChooseUs'],
            'dividingSection' => $data['dividingSection'],
            'company' => $data['company']
        ]);
    }
}
