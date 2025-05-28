<?php

namespace App\Http\Resources;

use App\Models\Regulation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Regulation */
class RegulationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'subtitle' => $this->getTranslations('subtitle'),
            'content' => $this->getTranslations('content'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
