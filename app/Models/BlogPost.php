<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class BlogPost extends Model
{
    use SoftDeletes, HasTranslations;

    public array $translatable = ['title', 'subtitle', 'content', 'slug'];
    protected $fillable = [
        'title',
        'subtitle',
        'image_path',
        'content',
        'galery',
        'categories_id',
        'user_id',
        'slug',
    ];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'galery' => 'array',
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
