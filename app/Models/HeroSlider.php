<?php

namespace App\Models;

use App\Traits\ClearsHomepageCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class HeroSlider extends Model
{
    use SoftDeletes, HasTranslations, ClearsHomepageCache;

    public array $translatable = ['title','subtitle','background_text'];

    protected $fillable = [
        'title',
        'subtitle',
        'background_text',
        'image_path',
    ];

    protected function casts(): array
    {
        return [
            //
        ];
    }
}
