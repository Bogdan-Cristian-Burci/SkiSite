<?php

namespace App\Http\Resources;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/** @mixin BlogPost */
class BlogPostResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'subtitle' => $this->getTranslations('subtitle'),
            'content' => $this->getTranslations('content'),
            'image_path' => $this->image_path,
            'image_url' => $this->image_path ? Storage::disk('public')->url($this->image_path) : null,
            'galery' => $this->galery,
            'gallery_urls' => $this->galery ? collect($this->galery)->map(fn($path) => Storage::disk('public')->url($path))->toArray() : [],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'categories_id' => $this->categories_id,
            'user_id' => $this->user_id,

            'categories' => new CategoriesResource($this->whenLoaded('categories')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
