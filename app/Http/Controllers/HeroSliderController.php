<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeroSliderRequest;
use App\Http\Resources\HeroSliderResource;
use App\Models\HeroSlider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class HeroSliderController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAny', HeroSlider::class);

        $locale = $request->get('locale', app()->getLocale());
        $heroSliders = HeroSlider::all();

        // Set locale for each model to get proper translations
        $heroSliders->each(function ($heroSlider) use ($locale) {
            $heroSlider->setLocale($locale);
        });

        return HeroSliderResource::collection($heroSliders);
    }

    public function store(HeroSliderRequest $request)
    {
        $this->authorize('create', HeroSlider::class);

        $validated = $request->validated();

        // Handle translatable fields
        if (isset($validated['title'])) {
            $heroSlider = new HeroSlider();
            $heroSlider->image_path = $validated['image_path'];

            // Set translations for title
            if (is_array($validated['title'])) {
                foreach ($validated['title'] as $locale => $title) {
                    $heroSlider->setTranslation('title', $locale, $title);
                }
            } else {
                $heroSlider->setTranslation('title', app()->getLocale(), $validated['title']);
            }

            if(is_array($validated['subtitle'])) {
                foreach ($validated['subtitle'] as $locale => $subtitle) {
                    $heroSlider->setTranslation('subtitle', $locale, $subtitle);
                }
            }else{
                $heroSlider->setTranslation('subtitle', app()->getLocale(), $validated['subtitle']);
            }

            if(is_array($validated['background_text'])) {
                foreach ($validated['background_text'] as $locale => $backgroundText) {
                    $heroSlider->setTranslation('background_text', $locale, $backgroundText);
                }
            } else {
                $heroSlider->setTranslation('background_text', app()->getLocale(), $validated['background_text']);
            }

            $heroSlider->save();
        } else {
            $heroSlider = HeroSlider::create($validated);
        }

        return new HeroSliderResource($heroSlider);
    }

    public function show(Request $request, HeroSlider $heroSlider)
    {
        $this->authorize('view', $heroSlider);

        $locale = $request->get('locale', app()->getLocale());
        $heroSlider->setLocale($locale);

        return new HeroSliderResource($heroSlider);
    }

    public function update(HeroSliderRequest $request, HeroSlider $heroSlider)
    {
        $this->authorize('update', $heroSlider);

        $validated = $request->validated();

        // Handle translatable fields
        if (isset($validated['title'])) {
            if (is_array($validated['title'])) {
                foreach ($validated['title'] as $locale => $title) {
                    $heroSlider->setTranslation('title', $locale, $title);
                }
                unset($validated['title']);
            } else {
                $locale = $request->get('locale', app()->getLocale());
                $heroSlider->setTranslation('title', $locale, $validated['title']);
                unset($validated['title']);
            }
        }

        if (isset($validated['subtitle'])) {
            if (is_array($validated['subtitle'])) {
                foreach ($validated['subtitle'] as $locale => $subtitle) {
                    $heroSlider->setTranslation('subtitle', $locale, $subtitle);
                }
                unset($validated['subtitle']);
            } else {
                $locale = $request->get('locale', app()->getLocale());
                $heroSlider->setTranslation('subtitle', $locale, $validated['subtitle']);
                unset($validated['subtitle']);
            }
        }

        if (isset($validated['background_text'])) {
            if (is_array($validated['background_text'])) {
                foreach ($validated['background_text'] as $locale => $backgroundText) {
                    $heroSlider->setTranslation('background_text', $locale, $backgroundText);
                }
                unset($validated['background_text']);
            } else {
                $locale = $request->get('locale', app()->getLocale());
                $heroSlider->setTranslation('background_text', $locale, $validated['background_text']);
                unset($validated['background_text']);
            }
        }

        // Update non-translatable fields
        if (!empty($validated)) {
            $heroSlider->update($validated);
        } else {
            $heroSlider->save();
        }

        return new HeroSliderResource($heroSlider);
    }

    public function destroy(HeroSlider $heroSlider)
    {
        $this->authorize('delete', $heroSlider);

        $heroSlider->delete();

        return response()->json();
    }
}
