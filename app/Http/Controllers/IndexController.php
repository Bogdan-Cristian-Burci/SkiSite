<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\HeroSlider;
use App\Models\SkiInstructor;
use App\Models\SkiProgram;
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

        // Set locale for each model to get proper translations
        $heroSliders->each(function ($heroSlider) use ($locale) {
            $heroSlider->setLocale($locale);
        });

        return view('index', compact('heroSliders', 'skiPrograms', 'skiInstructors', 'camps'));
    }
}
