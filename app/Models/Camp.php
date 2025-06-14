<?php

namespace App\Models;

use App\Traits\ClearsHomepageCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Camp extends Model
{
    use SoftDeletes, HasTranslations, ClearsHomepageCache;

    public array $translatable = [
        'title',
        'age_condition',
        'location',
        'price_info',
        'transport_info',
        'meal_info',
        'accommodation_info',
        'article_content',
        'slug'
    ];
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'age_condition',
        'location',
        'image_path',
        'latitude',
        'longitude',
        'price_info',
        'transport_info',
        'meal_info',
        'accommodation_info',
        'article_content',
        'capacity',
        'slug'
    ];

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'start_date' => 'date',
            'end_date' => 'date',
            'age_condition' => 'array',
            'location' => 'array',
            'price_info' => 'array',
            'transport_info' => 'array',
            'meal_info' => 'array',
            'accommodation_info' => 'array',
            'article_content' => 'array',
        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['number_of_adults', 'number_of_children'])
            ->withTimestamps();
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
