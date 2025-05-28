<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
}
