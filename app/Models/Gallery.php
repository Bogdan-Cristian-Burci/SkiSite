<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Gallery extends Model
{
    use SoftDeletes, HasTranslations;

    public array $translatable = ['title'];
    protected $fillable = [
        'title',
        'image_path',
    ];
}
