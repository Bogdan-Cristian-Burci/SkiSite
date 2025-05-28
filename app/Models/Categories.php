<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Categories extends Model
{
    use SoftDeletes, HasTranslations;

    public array $translatable = ['name', 'description'];
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class, 'categories_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $name = is_array($model->name) ? ($model->name['en'] ?? array_values($model->name)[0]) : $model->name;
                $model->slug = Str::slug($name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name') && empty($model->slug)) {
                $name = is_array($model->name) ? ($model->name['en'] ?? array_values($model->name)[0]) : $model->name;
                $model->slug = Str::slug($name);
            }
        });
    }
}
