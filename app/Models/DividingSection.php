<?php

namespace App\Models;

use App\Traits\ClearsHomepageCache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DividingSection extends Model
{
    use HasTranslations, ClearsHomepageCache;

    protected $fillable = [
        'title',
        'subtitle',
        'image_path',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public $translatable = ['title', 'subtitle'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
