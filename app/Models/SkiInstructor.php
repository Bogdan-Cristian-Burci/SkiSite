<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class SkiInstructor extends Model
{
    use SoftDeletes, HasTranslations;

    public array $translatable = ['position', 'bio'];

    protected $fillable = [
        'position',
        'image_path',
        'bio',
        'user_id',
        'slug',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
