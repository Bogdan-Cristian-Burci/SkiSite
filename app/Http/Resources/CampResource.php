<?php

namespace App\Http\Resources;

use App\Models\Camp;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/** @mixin Camp */
class CampResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'article_content' => $this->getTranslations('article_content'),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'age_condition' => $this->getTranslations('age_condition'),
            'location' => $this->getTranslations('location'),
            'image_path' => $this->image_path,
            'image_url' => $this->image_path ? Storage::disk('public')->url($this->image_path) : null,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'price_info' => $this->getTranslations('price_info'),
            'transport_info' => $this->getTranslations('transport_info'),
            'meal_info' => $this->getTranslations('meal_info'),
            'accommodation_info' => $this->getTranslations('accommodation_info'),
            'capacity' => $this->capacity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
