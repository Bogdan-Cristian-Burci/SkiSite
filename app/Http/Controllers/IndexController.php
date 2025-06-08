<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Camp;
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

        // Get all hero sliders
        $heroSliders = HeroSlider::all();
        $skiPrograms= SkiProgram::all();
        $skiInstructors = SkiInstructor::take(2)->get();
        $camps = Camp::take(3)->get();
        $blogs = BlogPost::with(['categories'])->orderBy('created_at', 'desc')->take(2)->get();
        $testimonials = Testimonial::take(10)->get();
        
        // Get new home page sections
        $popularDestinations = PopularDestination::active()->ordered()->get();
        $whyChooseUs = WhyChooseUs::active()->ordered()->get();
        $dividingSection = DividingSection::active()->first();
        
        // Set locale for each model to get proper translations
        $heroSliders->each(function ($heroSlider) use ($locale) {
            $heroSlider->setLocale($locale);
        });

        return view('index', compact('heroSliders', 'skiPrograms', 'skiInstructors', 'camps','blogs', 'testimonials', 'popularDestinations', 'whyChooseUs', 'dividingSection'));
    }
}
