<?php

namespace App\Http\Resources;

use App\Models\SkiProgram;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/** @mixin SkiProgram */
class SkiProgramResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'description' => $this->getTranslations('description'),
            'price_label' => $this->getTranslations('price_label'),
            'details' => $this->getTranslations('details'),
            'included_services' => $this->getTranslations('included_services'),
            'how_we_work' => $this->getTranslations('how_we_work'),
            'slug' => $this->getTranslations('slug'),
            'price' => $this->price,
            'image_path' => $this->image_path,
            'image_url' => $this->image_path ? Storage::disk('public')->url($this->image_path) : null,
            'gallery' => $this->gallery,
            'gallery_urls' => $this->gallery ? collect($this->gallery)->map(fn($path) => Storage::disk('public')->url($path))->toArray() : [],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
