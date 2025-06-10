<?php

namespace App\Models;

use App\Traits\ClearsHomepageCache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PopularDestination extends Model
{
    use HasTranslations, ClearsHomepageCache;

    protected $fillable = [
        'title',
        'url',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public $translatable = ['title'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
