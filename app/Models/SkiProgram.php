<?php

namespace App\Models;

use App\Traits\ClearsHomepageCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class SkiProgram extends Model
{
    use SoftDeletes, HasTranslations, ClearsHomepageCache;

    public array $translatable = [
        'title',
        'description',
        'price_label',
        'details',
        'included_services',
        'how_we_work',
        'slug',
    ];
    protected $fillable = [
        'title',
        'image_path',
        'description',
        'price',
        'price_label',
        'details',
        'included_services',
        'how_we_work',
        'gallery',
        'slug',
    ];

    protected function casts()
    {
        return [
            'details' => 'array',
            'included_services' => 'array',
            'gallery' => 'array',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $title = is_array($model->title) ? ($model->title['en'] ?? array_values($model->title)[0]) : $model->title;
                $baseSlug = Str::slug($title);
                
                $model->slug = [
                    'en' => $baseSlug,
                    'ro' => $baseSlug
                ];
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title') && empty($model->slug)) {
                $title = is_array($model->title) ? ($model->title['en'] ?? array_values($model->title)[0]) : $model->title;
                $baseSlug = Str::slug($title);
                
                $model->slug = [
                    'en' => $baseSlug,
                    'ro' => $baseSlug
                ];
            }
        });
    }
}
