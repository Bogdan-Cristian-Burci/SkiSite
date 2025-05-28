<?php

namespace App\Http\Resources;

use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin HeroSlider */
class HeroSliderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = $request->get('locale', app()->getLocale());

        return [
            'id' => $this->id,
            'title' => $this->getTranslation('title', $locale),
            'title_translations' => $this->getTranslations('title'),
            'subtitle' => $this->getTranslation('subtitle', $locale),
            'subtitle_translations' => $this->getTranslations('subtitle'),
            'background_text' => $this->getTranslation('background_text', $locale),
            'background_text_translations' => $this->getTranslations('background_text'),
            'image_path' => $this->image_path,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
