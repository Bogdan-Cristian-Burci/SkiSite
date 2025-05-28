<?php

namespace App\Http\Resources;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Categories */
class CategoriesResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->getTranslations('name'),
            'slug' => $this->slug,
            'description' => $this->getTranslations('description'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
