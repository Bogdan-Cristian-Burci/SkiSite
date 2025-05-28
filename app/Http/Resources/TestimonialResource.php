<?php

namespace App\Http\Resources;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/** @mixin Testimonial */
class TestimonialResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'author_name' => $this->author_name,
            'author_image_path' => $this->author_image_path,
            'author_image_url' => $this->author_image_path ? Storage::disk('public')->url($this->author_image_path) : null,
            'content' => $this->getTranslations('content'),
            'social_link' => $this->social_link,
            'approved_status' => $this->approved_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
